<?php

namespace app\controllers;

use Yii;
use app\models\AnalysisRequest;
use app\models\AnalysisRequestSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\PemohonAnalisis;
use app\models\Sampel;

/**
 * AnalysisRequestController implements the CRUD actions for AnalysisRequest model.
 */
class AnalysisRequestController extends Controller
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
     * Lists all AnalysisRequest models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new AnalysisRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single AnalysisRequest model.
     * @param string $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new AnalysisRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new AnalysisRequest();
        $pemohon = new PemohonAnalisis();
        $sampel = new Sampel();

        if ($model->load(Yii::$app->request->post()) && $pemohon->load(Yii::$app->request->post()) && $sampel->load(Yii::$app->request->post())) {
            $pemohon -> save();
            $sampel -> save();
            $model -> tanggal_diterima = date('Y-m-d');
            $model -> save();
            return $this->redirect(['view', 'id' => $model -> lpsb_order_no]);
        } else {
            return $this->render('create', [
                'model' => $model,
                'pemohon' => $pemohon,
                'sampel' => $sampel,
            ]);
        }
    }

    /**
     * Updates an existing AnalysisRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->lpsb_order_no]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing AnalysisRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the AnalysisRequest model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param string $id
     * @return AnalysisRequest the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findInModel($id)
    {
        $model = AnalysisRequest::findModel($id);
        $idSampel = $model -> id_sampel;
        if ($sampel = (Sampel::find($id) -> where(['=', '$id', '$idSampel']) -> all() !== null)) {
            return $sampel;
        } else {
            throw new NotFoundHttpException('The requested Sample in Model is not found.');
        }
    }

    protected function findModel($id)
    {
        if (($model = AnalysisRequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested model does not exist.');
        }
    }

    protected function findPemohonAnalisis($id)
    {
        if (($pemohon = PemohonAnalisis::findOne($id)) !== null) {
            return $pemohon;
        } else {
            throw new NotFoundHttpException('The requested "Pemohon Analisis" does not exist.');
        }
    }

    protected function findSampel($id)
    {
        if (($sampel = Sampel::find($id)->all()) !== null) {
            return $sampel;
        } else {
            throw new NotFoundHttpException('The requested Sampel does not exist.');
        }
    }

}
