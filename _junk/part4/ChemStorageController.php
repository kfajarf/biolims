<?php

namespace app\controllers;

use Yii;
use yii\web\Response;
use yii\widgets\ActiveForm;
use app\models\ChemStorage;
use app\models\ChemStorageSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Reagen;
use app\models\Model;

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
        $searchModel = new ChemStorageSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
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
        return $this->render('view', [
            'model' => $this->findModel($id),
            'reagen' => $this-> findReagen($id)
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
        $reagen = [new Reagen()];

        if ($model -> load(Yii::$app->request->post())) {

            $reagen = Model::createMultiple(Reagen::classname());
            Model::loadMultiple($reagen, Yii::$app->request->post());

            // validate all models
            $valid = $model->validate(true);
            $valid = Model::validateMultiple($reagen) && $valid;
            $model -> tanggal_masuk = date('Y-m-d');
            if (true) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($reagen as $iReagen) {
                            $iReagen -> id_storage = $model -> id_storage;
                            if (! ($flag = $iReagen->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $reagen -> save();
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model -> id_storage]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'reagen' => (empty($reagen)) ? [new Reagen] : $reagen
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
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id_storage]);
        } else {
            return $this->render('update', [
                'model' => $model,
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
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
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
            throw new NotFoundHttpException('The requested model does not exist.');
        }
    }

    protected function findReagen($id)
    {
        if (($model = Reagen::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested Reagen does not exist.');
        }
    }

    protected function findInModel($id)
    {
        if (($model = ChemStorage::find() -> where(['=', id_storage, '$id']) -> all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    protected function checkStock($reagen)
    {
        if ($reagen -> jumlah <= $reagen -> jumlah_minimum)
        {
            $reagen -> status = "LOW STOCK";
        } else {
            $reagen -> status = "Available";
        }
    }
}
