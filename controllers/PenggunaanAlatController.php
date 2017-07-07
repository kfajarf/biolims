<?php

namespace app\controllers;

use Yii;
use app\models\PenggunaanAlat;
use app\models\PenggunaanAlatSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PenggunaanAlatController implements the CRUD actions for PenggunaanAlat model.
 */
class PenggunaanAlatController extends Controller
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
     * Lists all PenggunaanAlat models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->checkPrivilege();
        $searchModel = new PenggunaanAlatSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single PenggunaanAlat model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->checkPrivilege();
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new PenggunaanAlat model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->checkPrivilege();
        $model = new PenggunaanAlat();

        if ($model->load(Yii::$app->request->post())) {
            $isAlreadyBorrowed = \app\models\PenggunaanAlat::find()->where(['kit_id' => $model->kit_id, 'tanggal_penggunaan' => $model->tanggal_penggunaan])->all();
            var_dump(count($isAlreadyBorrowed));die();
            if(count($isAlreadyBorrowed) > 1) throw new NotFoundHttpException('Alat sudah dibooking pada tanggal tersebut');
            else $model->save();
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing PenggunaanAlat model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->checkPrivilege();
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing PenggunaanAlat model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->checkPrivilege();
        $this->findModel($id)->delete();
        // var_dump("TEST");die();
        return $this->redirect(['index']);
    }

    /**
     * Finds the PenggunaanAlat model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return PenggunaanAlat the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = PenggunaanAlat::findOne($id)) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function findPengguna($id)
    {
        if(($pengguna = PenggunaanAlat::find() -> where(['=', 'kit_id', $id]) -> one()) != null)
        {
            return $pengguna;
        } else {
            return null;
        }
    }

    public function checkPrivilege() {
        if (Yii::$app->user->isGuest) throw new \yii\web\HttpException(403, 'You don\'t have permission to access this page.');
    }
}
