<?php

namespace app\controllers;

use Yii;
use app\models\AnalysisRequest;
use app\models\AnalysisRequestSearch;
use app\models\SampelSearch;
use app\models\Sampel;
use app\models\KategoriAnalisis;
use app\models\DataJasaLayanan;
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
use yii\web\Session;

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
        /*$date = date('Y-m-d');
        $date2 = date('2017-01-04');
        var_dump(date('2017-01-04'));
        var_dump(date('Y-m-d', strtotime($date2. '+ 20 day')));
        var_dump($date2);
        die();*/
        $searchModel = new AnalysisRequestSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionLunas($id)
    {
        $model = $this->findModel($id);
        if($model) $model->status = 'lunas';
        if($model->save()) return $this->redirect(['index']);
        else throw new Exception("Error Processing Request", 1);
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
        $kategoriAnalisis = $model->kategoriAnalisis;
        $pemohon = $this->findPemohon($id);

        return $this->render('view', [
            'model' => $model,
            'kategoriAnalisis' => $kategoriAnalisis,
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
        /*
            $modelPerson = new Person;
            $modelsHouse = [new House];
            $modelsRoom = [[new Room]];
        */

        $this->checkPrivilege();
        $model = new AnalysisRequest;
        $pemohon = new PemohonAnalisis;
        $modelsKAnalisis = [new KategoriAnalisis];
        $modelsSampel = [[new Sampel]];

        if ($model->load(Yii::$app->request->post()) && $pemohon->load(Yii::$app->request->post())) {

            $modelsKAnalisis = Model::createMultiple(KategoriAnalisis::classname());
            Model::loadMultiple($modelsKAnalisis, Yii::$app->request->post());

            $model->tanggal_diterima = date('2017-01-04');
            $model->tanggal_selesai = date('Y-m-d', strtotime($model->tanggal_diterima. '+ 20 day'));
            $model->sisa = $model->total_biaya - $model->dp;
            $model->save();
            $pemohon->request_id = $model->id;
            $pemohon->save();
            // var_dump($pemohon->save());die();
            
            // validate AR and KA models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsKAnalisis) && $valid;
            if (isset($_POST['Sampel'][0][0])) {
                foreach ($_POST['Sampel'] as $indexAnalisis => $sampels) {
                    foreach ($sampels as $indexSampel => $sampel) {
                        $data['Sampel'] = $sampel;
                        $modelSampel = new Sampel;
                        $modelSampel->load($data);
                        $modelsSampel[$indexAnalisis][$indexSampel] = $modelSampel;
                        $valid = $modelSampel->validate();
                    }
                }
            }

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsKAnalisis as $indexAnalisis => $modelKAnalisis) {

                            if ($flag === false) {
                                break;
                            }

                            $modelKAnalisis->request_id = $model->id;

                            if (!($flag = $modelKAnalisis->save(false))) {
                                break;
                            }

                            if (isset($modelsSampel[$indexAnalisis]) && is_array($modelsSampel[$indexAnalisis])) {
                                foreach ($modelsSampel[$indexAnalisis] as $indexSampel => $modelSampel) {
                                    $modelSampel->kategori_analisis_id = $modelKAnalisis->id;
                                    if (!($flag = $modelSampel->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['index']);
                            // 'view', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('create', [
            'model' => $model,
            'modelsKAnalisis' => (empty($modelsKAnalisis)) ? [new KategoriAnalisis] : $modelsKAnalisis,
            'modelsSampel' => (empty($modelsSampel)) ? [[new Sampel]] : $modelsSampel,
            'pemohon' => $pemohon,
        ]);
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $pemohon = $this->findPemohon($model->id);
        $modelsKAnalisis = $model->kategoriAnalisis;
        $modelsSampel = [];
        $oldSampels = [];

        if (!empty($modelsKAnalisis)) {
            foreach ($modelsKAnalisis as $indexAnalisis => $modelKAnalisis) {
                $sampels = $modelKAnalisis->sampels;
                $modelsSampel[$indexAnalisis] = $sampels;
                $oldSampels = ArrayHelper::merge(ArrayHelper::index($sampels, 'id'), $oldSampels);
            }
        }

        if ($model->load(Yii::$app->request->post()) && $pemohon->load(Yii::$app->request->post())) {

            // reset
            $model->sisa = $model->total_biaya - $model->dp;
            $model->save();
            $pemohon->request_id = $model->id;
            $pemohon->save();
            $modelsSampel = [];

            $oldKAnalisisIDs = ArrayHelper::map($modelsKAnalisis, 'id', 'id');
            $modelsKAnalisis = Model::createMultiple(KategoriAnalisis::classname(), $modelsKAnalisis);
            Model::loadMultiple($modelsKAnalisis, Yii::$app->request->post());
            $deletedKanalisisIDs = array_diff($oldKAnalisisIDs, array_filter(ArrayHelper::map($modelsKAnalisis, 'id', 'id')));

            // validate person and houses models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsKAnalisis) && $valid;

            $sampelsIDs = [];
            if (isset($_POST['Sampel'][0][0])) {
                foreach ($_POST['Sampel'] as $indexAnalisis => $sampels) {
                    $sampelsIDs = ArrayHelper::merge($sampelsIDs, array_filter(ArrayHelper::getColumn($sampels, 'id')));
                    foreach ($sampels as $indexSampel => $sampel) {
                        $data['Sampel'] = $sampel;
                        $modelSampel = (isset($sampel['id']) && isset($oldSampels[$sampel['id']])) ? $oldSampels[$sampel['id']] : new Sampel;
                        $modelSampel->load($data);
                        $modelsSampel[$indexAnalisis][$indexSampel] = $modelSampel;
                        $valid = $modelSampel->validate();
                    }
                }
            }

            $oldSampelsIDs = ArrayHelper::getColumn($oldSampels, 'id');
            $deletedSampelsIDs = array_diff($oldSampelsIDs, $sampelsIDs);

            if ($valid) {
                $transaction = Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {

                        if (! empty($deletedSampelsIDs)) {
                            Sampel::deleteAll(['id' => $deletedSampelsIDs]);
                        }

                        if (! empty($deletedKanalisisIDs)) {
                            KategoriAnalisis::deleteAll(['id' => $deletedKanalisisIDs]);
                        }

                        foreach ($modelsKAnalisis as $indexAnalisis => $modelKAnalisis) {

                            if ($flag === false) {
                                break;
                            }

                            $modelKAnalisis->request_id = $model->id;

                            if (!($flag = $modelKAnalisis->save(false))) {
                                break;
                            }

                            if (isset($modelsSampel[$indexAnalisis]) && is_array($modelsSampel[$indexAnalisis])) {
                                foreach ($modelsSampel[$indexAnalisis] as $indexSampel => $modelSampel) {
                                    $modelSampel->kategori_analisis_id = $modelKAnalisis->id;
                                    if (!($flag = $modelSampel->save(false))) {
                                        break;
                                    }
                                }
                            }
                        }
                    }

                    if ($flag) {
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    } else {
                        $transaction->rollBack();
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsKAnalisis' => (empty($modelsKAnalisis)) ? [new KategoriAnalisis] : $modelsKAnalisis,
            'modelsSampel' => (empty($modelsSampel)) ? [[new Sampel]] : $modelsSampel,
            'pemohon' => $pemohon,
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
        $sampel = $this->findSampel($model->lpsb_order_no);
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
        $pemohon = $this->findPemohon($id);
        $data = $this->findDataJasaLayanan($id);
        $content = $this->renderPartial('permohonanAnalisis', [
            'model' => $model,
            'pemohon' => $pemohon,
            'data' => $data,
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
        $model = $this->findModel($id);
        $name = $model->lpsb_order_no;

        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Record  <strong>"' . $name . '"</strong> deleted successfully.');
        }

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
        if (($model = DataJasaLayanan::find()->where(['=', 'lpsb_order_no', $lpsbId])->asArray()->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested Sampel does not exist.');
        }
    }

    public function findDataJasaLayanan($lpsbId)
    {
        if (($model = DataJasaLayanan::find()->where(['=', 'id', $lpsbId])->asArray()->all()) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested Data does not exist.');
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

    public function unique_multidim_array($array, $key) { 
        $temp_array = array(); 
        $i = 0; 
        $key_array = array(); 
        
        foreach($array as $val) { 
            if (!in_array($val[$key], $key_array)) { 
                $key_array[$i] = $val[$key]; 
                $temp_array[$i] = $val; 
            } 
            $i++; 
        } 
        return $temp_array; 
    } 
}
