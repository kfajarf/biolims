<?php

namespace app\controllers;

use Yii;
use app\models\SuratKeluar;
use app\models\SuratKeluarSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * SuratKeluarController implements the CRUD actions for SuratKeluar model.
 */
class SuratKeluarController extends Controller
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
     * Lists all SuratKeluar models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SuratKeluarSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single SuratKeluar model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new SuratKeluar model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new SuratKeluar();

        if ($model->load(Yii::$app->request->post())) {
            $model->file_surat = UploadedFile::getInstance($model, 'file_surat');

            $filename = 'Surat Keluar - ';
            $filename .= pathinfo($model->file_surat , PATHINFO_FILENAME);
            $ext = pathinfo($model->file_surat , PATHINFO_EXTENSION);

            $newFname = $filename.'.'.$ext;

            $path=Yii::getAlias('@webroot').'/uploads/surat keluar/';
            if(!empty($newFname)){
                $model->file_surat->saveAs($path.$newFname);
                $model->file_surat = $newFname;
                if($model->save()){
                    return $this->redirect(['index']);
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing SuratKeluar model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post())) {
            $model->file_surat = UploadedFile::getInstance($model, 'file_surat');

            $filename = 'Surat Keluar - ';
            $filename .= pathinfo($model->file_surat , PATHINFO_FILENAME);
            $ext = pathinfo($model->file_surat , PATHINFO_EXTENSION);

            $newFname = $filename.'.'.$ext;

            $path=Yii::getAlias('@webroot').'/uploads/surat keluar/';
            if(!empty($newFname)){
                $model->file_surat->saveAs($path.$newFname);
                $model->file_surat = $newFname;
                if($model->save()){
                    return $this->redirect(['view', 'id' => $model->id]);
                }
            }
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing SuratKeluar model.
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
     * Finds the SuratKeluar model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SuratKeluar the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    public function actionDownload($id) 
    { 
        $download = SuratKeluar::findOne($id); 
        $path=Yii::getAlias('@webroot').'/uploads/surat keluar/'.$download->file_surat;

        if (file_exists($path)) {
            return Yii::$app->response->sendFile($path);
        }
    }

    protected function findModel($id)
    {
        if (($model = SuratKeluar::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
