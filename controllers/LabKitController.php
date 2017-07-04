<?php

namespace app\controllers;

use Yii;
use app\models\LabKit;
use app\models\LabKitSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\ForbiddenHttpException;
use yii\filters\VerbFilter;
use app\models\PenggunaanAlat;
use app\models\PenggunaanAlatSearch;
use yii\helpers\VarDumper;

/**
 * LabKitController implements the CRUD actions for LabKit model.
 */
class LabKitController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LabKit models.
     * @return mixed
     */
    public function actionIndex()
    {
        $models = LabKit::find()->where(['not', ['id' => NULL]])->all();
        foreach ($models as $idx => $model) {
            $this->checkStatus($model->id);
        }
        $searchModel = new LabKitSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'models' => $models,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single LabKit model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new LabKit model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new LabKit();

        if ($model->load(Yii::$app->request->post())) {
            $model->save();
            $model->kalibrasi_selanjutnya = $this->setSchedule($model->id);
            $model->save();
            return $this->redirect(['index']);
        } else {
            return $this->renderAjax('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing LabKit model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->renderAjax('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing LabKit model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(['index']);
    }

    public function actionDeleteLog($id)
    {
        $pengguna = \app\models\PenggunaanAlat::find()->where(['id' => $id])->one();
        $pengguna->delete();
        
        return $this->redirect(['//penggunaan-alat/index']);
    }

    public function actionPeminjaman()
    {
        $pengguna = new PenggunaanAlat;

        if ($pengguna->load(Yii::$app->request->post())) {
            $isAlreadyBorrowed = \app\models\PenggunaanAlat::find()->where(['kit_id' => $pengguna->kit_id, 'tanggal_penggunaan' => $pengguna->tanggal_penggunaan])->all();
            if(count($isAlreadyBorrowed) > 1) {
                throw new ForbiddenHttpException('Alat sudah dibooking pada tanggal tersebut');
                // var_dump(count($isAlreadyBorrowed));die();
            }
            else $pengguna->save();
            return $this->redirect(['//penggunaan-alat/index']);
        } else {
            return $this->renderAjax('//penggunaan-alat/_form', [
                'pengguna' => $pengguna,
            ]);
        }
    }

    public function actionListPeminjaman()
    {
        $searchModel = new PenggunaanAlatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('//penggunaan-alat/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Finds the LabKit model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return LabKit the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = LabKit::findOne($id)) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function setSchedule($id)
    {
        $model = LabKit::findOne($id);
        $mulai = $model->tanggal_mulai;
        $jangka = $model->jangka_kalibrasi;
        $model->kalibrasi_selanjutnya = date('Y-m-d', strtotime("+".$jangka." Weeks", strtotime($mulai)));
        return $model->kalibrasi_selanjutnya;
    }

    public function resetSchedule($id)
    {
        $model = LabKit::findOne($id);
        $today = strtotime(date('Y-m-d'))/*new \yii\db\Expression("NOW()")*/;
        $kalibrasi = $model->kalibrasi_selanjutnya;
        $baru = date('Y-m-d', strtotime("+".$model->jangka_kalibrasi." Weeks", $today));
        if($today > $kalibrasi)
        {
            $model->kalibrasi_selanjutnya = $baru;
        }
        $model->save();
    }

    public function checkDate($id)
    {
        $model = LabKit::findOne($id);
        $today = date('Y-m-d');
        $next = $model->kalibrasi_selanjutnya;
        $kalibrasi =  date('Y-m-d',strtotime($next));
        if ($today >= $kalibrasi)
        {
            return true;
        } else {
            return false;
        }
    }

    public function checkStatus($id)
    {
        $model = LabKit::find()->where(['id' => $id])->one();
        $today = date('Y-m-d');
        $pengguna = PenggunaanAlat::find()->where(['kit_id' => $id, 'tanggal_penggunaan' => $today])->one();
        // var_dump($pengguna->tanggal_penggunaan);
        // die();
        if($pengguna != null)
        {
            if($today == $pengguna->tanggal_penggunaan)
            {
                $model->status_penggunaan = "digunakan";
            } 
        }
        else $model->status_penggunaan = "tersedia";
        $model->save();
    }
}