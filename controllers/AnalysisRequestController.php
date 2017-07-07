<?php

namespace app\controllers;

use Yii;
use app\models\AnalysisRequest;
use app\models\AnalysisRequestSearch;
use app\models\SampelSearch;
use app\models\Sampel;
use app\models\ViewSampel;
use app\models\PemohonAnalisis;
use app\models\KajiUlang;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\Model;
use yii\web\Response;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\mpdf\Pdf;

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
        $this->checkPrivilege();
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
        $this->checkPrivilege();
        $model = $this->findModel($id);
        $lpsbId = $model->id;
        $sampel = $this->findSampel($lpsbId);
        $pemohon = $this->findPemohon($lpsbId);
        return $this->render('view', [
            'model' => $model,
            'sampel' => $sampel,
            'pemohon' => $pemohon,

        ]);
    }

    /**
     * Creates a new AnalysisRequest model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->checkPrivilege();
        $model = new AnalysisRequest();
        $modelsSampel = [new Sampel];
        $pemohon = new PemohonAnalisis();


        if ($model->load(Yii::$app->request->post()) && $pemohon->load(Yii::$app->request->post())) 
        {
            $modelsSampel = Model::createMultiple(Sampel::classname());
            Model::loadMultiple($modelsSampel, Yii::$app->request->post());
            
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsSampel),
                    ActiveForm::validate($model) 
                );
            }
            
            // $model->tanggal_diterima = date('Y-m-d');

            // validate all models
            
            $valid = $model->validate();
            // print_r($model->getErrors());
            $model->sisa = $model->total_biaya - $model->dp;
            $model->save();
            $pemohon->request_id = $model->id;
            $pemohon->save();
            var_dump($valid);
            die();
            $valid = Model::validateMultiple($modelsSampel) && $valid;
            // var_dump($valid);die();
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsSampel as $modelSampel) {
                            $modelSampel->request_id = $model->id;
                            if (! ($flag = $modelSampel->save(false))) {
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
                'modelsSampel' => (empty($modelsSampel)) ? [new Sampel] : $modelsSampel,
                'pemohon' => $pemohon,
            ]);
        }
    }

    public function actionUpdate($id)
    {
        $this->checkPrivilege();
        $modelCustomer = $this->findModel($id);
        $modelsAddress = $modelCustomer->addresses;

        if ($modelCustomer->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsAddress, 'id', 'id');
            $modelsAddress = Model::createMultiple(Address::classname(), $modelsAddress);
            Model::loadMultiple($modelsAddress, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsAddress, 'id', 'id')));

            // ajax validation
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validateMultiple($modelsAddress),
                    ActiveForm::validate($modelCustomer)
                );
            }

            // validate all models
            $valid = $modelCustomer->validate();
            $valid = Model::validateMultiple($modelsAddress) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $modelCustomer->save(false)) {
                        if (! empty($deletedIDs)) {
                            Address::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsAddress as $modelAddress) {
                            $modelAddress->customer_id = $modelCustomer->id;
                            if (! ($flag = $modelAddress->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $modelCustomer->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'modelCustomer' => $modelCustomer,
            'modelsAddress' => (empty($modelsAddress)) ? [new Address] : $modelsAddress
        ]);
    }
    
/*
    public function actionUpdate($id)
    {
        $this->checkPrivilege();
        $model = $this->findModel($id);
        $pemohon = $this->findPemohon($model->id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('//pemohon-analisis/update', [
                'model' => $model,
                'pemohon' => $pemohon,
            ]);
        }
    }
*/
    public function actionKajiUlang($id)
    {
        $this->checkPrivilege();
        $model = AnalysisRequest::find()->where(['id' => $id])->one();
        $pemohon = PemohonAnalisis::find()->where(['request_id' => $id])->one();
        $kajiUlang = [new KajiUlang];

        $kajiUlang = Model::createMultiple(KajiUlang::classname());
        if (Model::loadMultiple($kajiUlang, Yii::$app->request->post())){
            
            if (Yii::$app->request->isAjax) {
                Yii::$app->response->format = Response::FORMAT_JSON;
                return ArrayHelper::merge(
                    ActiveForm::validate($model),
                    ActiveForm::validateMultiple($kajiUlang)
                );
            }

            // validate all models
            
            $valid = $model->validate();
            // print_r($model->getErrors());
            // var_dump($valid);
            // die();
            $valid = Model::validateMultiple($kajiUlang) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($kajiUlang as $kajiUlangItem) {
                            $kajiUlangItem->request_id = $model->id;
                            if (! ($flag = $kajiUlangItem->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('formKajiUlang', [
                'model' => $model,
                'kajiUlang' => (empty($kajiUlang)) ? [new KajiUlang] : $kajiUlang,
                'pemohon' => $pemohon,
            ]);
        }
    }    

    /**
     * Updates an existing AnalysisRequest model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param string $id
     * @return mixed
     */

    public function actionTandaTerimaSampel($id) {
    // get your HTML raw content without any layouts or scripts
        $model = $this->findModel($id);
        $lpsbId = $model->id;
        $sampel = $this->findSampel($lpsbId);
        $pemohon = $this->findPemohon($lpsbId);
        $content = $this->renderPartial('tandaTerimaSampel', [
            'model' => $model,
            'sampel' => $sampel,
            'pemohon' => $pemohon,
        ]);
     
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:12px}', 
             // set mPDF properties on the fly
            'options' => ['shrink_tables_to_fit' => 0],

            'filename' => 'Form 4_2 LPSB Order No '.$model->lpsb_order_no,
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>null, 
                'SetFooter'=>null,
            ]   
        ]);
 
    // return the pdf output as per the destination setting
        return $pdf->render();
    }  

    public function actionPermohonanAnalisis($id) {
    // get your HTML raw content without any layouts or scripts
        $model = $this->findModel($id);
        $lpsbId = $model->id;
        $sampel = $this->findSampel($lpsbId);
        $pemohon = $this->findPemohon($lpsbId);
        $content = $this->renderPartial('permohonanAnalisis', [
            'model' => $model,
            'sampel' => $sampel,
            'pemohon' => $pemohon,
        ]);
     
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_LANDSCAPE, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:12px}; page-break-after: never', 
             // set mPDF properties on the fly
            'options' => ['shrink_tables_to_fit' => 0],

            'filename' => 'Form 4_1 LPSB Order No '.$model->lpsb_order_no,
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>null, 
                'SetFooter'=>null,
            ]   
        ]);
 
    // return the pdf output as per the destination setting
        return $pdf->render();
    }   

    public function actionKajiUlangPdf($id) {
    // get your HTML raw content without any layouts or scripts
        $model = $this->findModel($id);
        $lpsbId = $model->id;
        $kajiUlang = KajiUlang::find()->where(['request_id' => $id])->asArray()->all();
        $pemohon = $this->findPemohon($lpsbId);
        $content = $this->renderPartial('_kajiUlangPdf', [
            'model' => $model,
            'kajiUlang' => $kajiUlang,
            'pemohon' => $pemohon,
        ]);
     
        // setup kartik\mpdf\Pdf component
        $pdf = new Pdf([
            // set to use core fonts only
            'mode' => Pdf::MODE_CORE, 
            // A4 paper format
            'format' => Pdf::FORMAT_A4, 
            // portrait orientation
            'orientation' => Pdf::ORIENT_PORTRAIT, 
            // stream to browser inline
            'destination' => Pdf::DEST_BROWSER, 
            // your html content input
            'content' => $content,  
            // format content from your own css file if needed or use the
            // enhanced bootstrap css built by Krajee for mPDF formatting 
            'cssFile' => '@vendor/kartik-v/yii2-mpdf/assets/kv-mpdf-bootstrap.min.css',
            // any css to be embedded if required
            'cssInline' => '.kv-heading-1{font-size:12px}', 
             // set mPDF properties on the fly
            'options' => ['shrink_tables_to_fit' => 0],

            'filename' => 'Form 4_4 LPSB Order No '.$model->lpsb_order_no,
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>null, 
                'SetFooter'=>null,
            ]   
        ]);
 
    // return the pdf output as per the destination setting
        return $pdf->render();
    }  
    /**
     * Deletes an existing AnalysisRequest model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param string $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->checkPrivilege();
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
    protected function findModel($id)
    {
        if (($model = AnalysisRequest::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested Model does not exist.');
        }
    }

    public function findSampel($lpsbId)
    {
        if (($model = ViewSampel::find()->where(['=', 'request_id', $lpsbId])->asArray()->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested Sampel does not exist.');
        }
    }

    public function findPemohon($lpsbId)
    {
        if (($model = PemohonAnalisis::find()->where(['=', 'request_id', $lpsbId])->one()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested "Pemohon Analisis" does not exist.');
        }
    }    

    public function checkPrivilege() {
        if (Yii::$app->user->isGuest) throw new \yii\web\HttpException(403, 'You don\'t have permission to access this page.');
    }
}
