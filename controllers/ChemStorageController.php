<?php

namespace app\controllers;

use Yii;
use app\models\ChemStorage;
use app\models\ReagenSearch;
use app\models\Reagen;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use yii\helpers\BaseUrl;
use kartik\mpdf\Pdf;

/**
 * ChemStorageController implements the CRUD actions for ChemStorage model.
 */
class ChemStorageController extends Controller
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
     * Lists all ChemStorage models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ReagenSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('//reagen/index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    
    /**
     * Displays a single ChemStorage model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $reagen = $this->findReagen($id);
        $idStorage = $reagen->id_storage;
        $model = $this->findModel($idStorage);
        $reagens = $model->reagens;
        $lokasi = $reagen->lokasi;
        $supplier = $reagen->supplier;

        return $this->render('//reagen/view', [
            'model' => $model,
            'reagen' => $reagen,
            'reagens' => $reagens,
            'lokasi' => $lokasi,
            'supplier' => $supplier,
        ]);
    }

    /**
     * Creates a new ChemStorage model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new ChemStorage();
        $modelsReagen = [new Reagen];

        if ($model->load(Yii::$app->request->post())) 
        {
            $model->tanggal_masuk = date('Y-m-d');
            $model->save();
            
            $modelsReagen = Model::createMultiple(Reagen::classname());
            Model::loadMultiple($modelsReagen, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsReagen) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsReagen as $modelReagen) {
                            $modelReagen->id_storage = $model->id;
                            if (! ($flag = $modelReagen->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsReagen' => (empty($modelsReagen)) ? [new Reagen] : $modelsReagen
            ]);
        }
    }

    /**
     * Updates an existing ChemStorage model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */

    public function actionUpdate($id)
    {
        $reagen = $this->findReagen($id);
        $idStorage = $reagen->id_storage;
        $model = $this->findModel($idStorage);

        if ($reagen->load(Yii::$app->request->post())) {
            $reagen->save();
            return $this->redirect(['view', 'id' => $reagen->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
                'reagen' => $reagen,
            ]);
        }
    }

    public function actionTakeReagen($id)
    {
        $reagen = $this->findReagen($id);
        $takeReagen = new \app\models\TakeReagen();

        if ($takeReagen->load(Yii::$app->request->post())) {
            $takeReagen->id_reagen = $reagen->id;
            $takeReagen->nama_reagen = $reagen->nama_reagen;
            $takeReagen->tanggal_pengambilan = date('Y-m-d');
            if($takeReagen->save()){
                $reagen->jumlah -= $takeReagen->jumlah;
                $reagen->save();
            }
            return $this->redirect(['view', 'id' => $reagen->id]);
        } else {
            return $this->renderAjax('_takeReagenForm', [
                'reagen' => $reagen,
                'takeReagen' => $takeReagen,
            ]);
        }

    }

    /**
     * Deletes an existing ChemStorage model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $reagen = $this->findReagen($id);
        $idStorage = $reagen->id_storage;
        $model = $this->findModel($idStorage);
        $this->findReagen($id)->delete();
        if($flag = $this->isEmptyStorage($idStorage))
        {
            $model->delete();
            return $this->redirect(['index']);
        } else 
            return $this->redirect(Yii::$app->request->refresh);
    }

    /**
     * Finds the ChemStorage model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return ChemStorage the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = ChemStorage::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested Storage does not exist.');
        }
    }

    public function findReagen($id)
    {
        if (($reagen = Reagen::findOne($id)) !== null) {
            return $reagen;
        } else {
            throw new NotFoundHttpException('The requested Reagen does not exist.');
        }
    }

    protected function isEmptyStorage($idStorage)
    {
        if (($reagen = Reagen::find()->where(['=', 'id_storage', $idStorage])->all()) == null)
        {
            return true;
        } else {
            return false;
        }
    }

    public function checkStock($id)
    {
        $reagen = Reagen::find()->where(['id' => $id])->one();
        $flag = false;

        if (($reagen->jumlah) <= ($reagen->jumlah_minimum))
        {
            $flag = true;
        }

        return $flag;
    }

    public function checkExpired($id)
    {
        $reagen = Reagen::find()->where(['id' => $id])->one();
        $kadaluarsa = $reagen->tanggal_kadaluarsa;
        $month = 3;
        $warning = strtotime("-".$month." Months", strtotime($kadaluarsa));
        $today = strtotime(date('Y-m-d'));
        $flag = false;

        if ($today >= $warning)
        {
            $flag = true;
        }

        return $flag;
    }
}
