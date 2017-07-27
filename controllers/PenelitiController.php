<?php

namespace app\controllers;

use Yii;
use app\models\Peneliti;
use app\models\Invoice;
use app\models\Kwitansi;
use app\models\SampelInvoice;
use app\models\PenelitiSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;
use app\models\Model;
use app\models\TempatPenelitianLain;
use app\models\PembimbingPenelitian;
use app\models\RekapitulasiBahan;
use app\models\RekapitulasiBahanSearch;
use kartik\mPDF\Pdf;

/**
 * PenelitiController implements the CRUD actions for Peneliti model.
 */
class PenelitiController extends Controller
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
     * Lists all Peneliti models.
     * @return mixed
     */
    public function actionIndex()
    {
        $this->checkPrivilege();
        $searchModel = new PenelitiSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Peneliti model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $this->checkPrivilege();
        $model = $this->findModel($id);
        $searchModel = new RekapitulasiBahanSearch();
        $dataProvider = $searchModel->search(\Yii::$app->request->queryParams, $model->id);
        // var_dump(\Yii::$app->request->queryParams);die();
        return $this->render('view', [
            'model' => $model,
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Creates a new Peneliti model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $this->checkPrivilege();
        $model = new Peneliti();
        $modelsPembimbing = [new PembimbingPenelitian];
        $modelsTempat = [new TempatPenelitianLain];

        if ($model->load(Yii::$app->request->post())) 
        {
            $modelsPembimbing = Model::createMultiple(PembimbingPenelitian::classname());
            Model::loadMultiple($modelsPembimbing, Yii::$app->request->post());
            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPembimbing) && $valid;

            // var_dump($valid);die();
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsPembimbing as $modelPembimbing) {
                            $modelPembimbing->id_peneliti = $model->id;
                            if (! ($flag = $modelPembimbing->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        ////////post modelsTempat/////////

                        $modelsTempat = Model::createMultiple(TempatPenelitianLain::classname());
                        Model::loadMultiple($modelsTempat, Yii::$app->request->post());
                        // validate all models
                        $valid = $model->validate();
                        $valid = Model::validateMultiple($modelsTempat) && $valid;
                        if ($valid) {
                            $transaction = \Yii::$app->db->beginTransaction();
                            try {
                                if ($flag = $model->save(false)) {
                                    foreach ($modelsTempat as $modelTempat) {
                                        $modelTempat->id_peneliti = $model->id;
                                        if (! ($flag = $modelTempat->save(false))) {
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
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        } else {
            return $this->render('create', [
                'model' => $model,
                'modelsPembimbing' => (empty($modelsPembimbing)) ? [new PembimbingPenelitian] : $modelsPembimbing,
                'modelsTempat' => (empty($modelsTempat)) ? [new TempatPenelitianLain] : $modelsTempat,
            ]);
        }
    }

    /**
     * Updates an existing Peneliti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $this->checkPrivilege();
        $model = $this->findModel($id);
        $modelsPembimbing = $model->pembimbingPenelitian;
        $modelsTempat = $model->tempatPenelitianLain;

        if ($model->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsPembimbing, 'id', 'id');
            $modelsPembimbing = Model::createMultiple(PembimbingPenelitian::classname(), $modelsPembimbing);
            Model::loadMultiple($modelsPembimbing, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsPembimbing, 'id', 'id')));

            // validate all models
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsPembimbing) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            PembimbingPenelitian::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsPembimbing as $modelPembimbing) {
                            $modelPembimbing->id_peneliti = $model->id;
                            if (! ($flag = $modelPembimbing->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $transaction->commit();
                        ///Post Data Tempat
                        $oldIDs = ArrayHelper::map($modelsTempat, 'id', 'id');
                        $modelsTempat = Model::createMultiple(TempatPenelitianLain::classname(), $modelsTempat);
                        Model::loadMultiple($modelsTempat, Yii::$app->request->post());
                        $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsTempat, 'id', 'id')));

                        // validate all models
                        $valid = $model->validate();
                        $valid = Model::validateMultiple($modelsTempat) && $valid;

                        if ($valid) {
                            $transaction = \Yii::$app->db->beginTransaction();
                            try {
                                if ($flag = $model->save(false)) {
                                    if (!empty($deletedIDs)) {
                                        TempatPenelitianLain::deleteAll(['id' => $deletedIDs]);
                                    }
                                    foreach ($modelsTempat as $modelTempat) {
                                        $modelTempat->id_peneliti = $model->id;
                                        if (! ($flag = $modelTempat->save(false))) {
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

                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('update', [
            'model' => $model,
            'modelsPembimbing' => (empty($modelsPembimbing)) ? [new PembimbingPenelitian] : $modelsPembimbing,
            'modelsTempat' => (empty($modelsTempat)) ? [new TempatPenelitianLain] : $modelsTempat,
        ]);
    }

    /**
     * Deletes an existing Peneliti model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->checkPrivilege();
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Peneliti model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Peneliti the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    
    public function actionCreateRekapitulasiBahan($id)
    {
        $this->checkPrivilege();
        $model = $this->findModel($id);
        $modelsBahan = [new RekapitulasiBahan];

        // if ($model->load(Yii::$app->request->post())) 
        // {
            $modelsBahan = Model::createMultiple(RekapitulasiBahan::classname());
        if (Model::loadMultiple($modelsBahan, Yii::$app->request->post())) {
            // validate all models
            $model->save();
            $valid = $model->validate();
            $valid = Model::validateMultiple($modelsBahan) && $valid;

            // var_dump($valid);die();
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        foreach ($modelsBahan as $modelBahan) {
                            $modelBahan->id_peneliti = $model->id;
                            if (! ($flag = $modelBahan->save(false))) {
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
            return $this->render('createRekapitulasiBahan', [
                'model' => $model,
                'modelsBahan' => (empty($modelsBahan)) ? [new RekapitulasiBahan] : $modelsBahan,
            ]);
        }
    }

    /**
     * Updates an existing Peneliti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateRekapitulasiBahan($id)
    {
        $this->checkPrivilege();
        $model = $this->findModel($id);
        $modelsBahan = $model->rekapitulasiBahan;
        // var_dump($modelsBahan);die();
        // if ($model->load(Yii::$app->request->post())) {
            $oldIDs = ArrayHelper::map($modelsBahan, 'id', 'id');
            $modelsBahanData = Model::createMultiple(RekapitulasiBahan::classname(), $modelsBahan);
        if (Model::loadMultiple($modelsBahanData, Yii::$app->request->post())) {
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsBahanData, 'id', 'id')));
            // validate all models
            $valid = $model->validate();
            // var_dump($valid);die();
            $valid = Model::validateMultiple($modelsBahanData) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $model->save(false)) {
                        if (!empty($deletedIDs)) {
                            RekapitulasiBahan::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsBahanData as $modelBahan) {
                            $modelBahan->id_peneliti = $model->id;
                            if (! ($flag = $modelBahan->save(false))) {
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
            return $this->render('updateRekapitulasiBahan', [
                'model' => $model,
                'modelsBahan' => (empty($modelsBahan)) ? [new RekapitulasiBahan] : $modelsBahan,
            ]);
        }
    }
    

    
    public function actionCreateInvoice($id)
    {
        $this->checkPrivilege();
        $model = $this->findModel($id);
        $invoice = new Invoice;
        $modelsBahan = $model->rekapitulasiBahan;

        if ($invoice->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsBahan, 'id', 'id');
            $modelsBahan = Model::createMultiple(RekapitulasiBahan::classname(), $modelsBahan);
            Model::loadMultiple($modelsBahan, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsBahan, 'id', 'id')));
            $invoice->id_peneliti = $model->id;
            $invoice->no_invoice .= '/I3.11.8/LPSB-INV/2017';
            $invoice->total_biaya = 0;
            $invoice->save();
            // validate all models
            $valid = $invoice->validate();
            // var_dump($valid);die();
            $valid = Model::validateMultiple($modelsBahan) && $valid;
            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $invoice->save(false)) {
                        if (!empty($deletedIDs)) {
                            RekapitulasiBahan::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsBahan as $modelBahan) {
                            $modelBahan->id_peneliti = $model->id;
                            $invoice->total_biaya += $modelBahan->harga;
                            if (! ($flag = $modelBahan->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $invoice->save();
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }
        ///////////////////////////////////
         else {
            return $this->render('createInvoice', [
                'model' => $model,
                'invoice' => $invoice,
                'modelsBahan' => (empty($modelsBahan)) ? [new RekapitulasiBahan] : $modelsBahan,
            ]);
        }
    }

    /**
     * Updates an existing Peneliti model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateInvoice($id)
    {
        $this->checkPrivilege();
        $model = $this->findModel($id);
        $invoice = Invoice::findOne(['id_peneliti' => $model->id]);
        $modelsBahan = $model->rekapitulasiBahan;

        if ($invoice->load(Yii::$app->request->post())) {

            $oldIDs = ArrayHelper::map($modelsBahan, 'id', 'id');
            $modelsBahan = Model::createMultiple(RekapitulasiBahan::classname(), $modelsBahan);
            Model::loadMultiple($modelsBahan, Yii::$app->request->post());
            $deletedIDs = array_diff($oldIDs, array_filter(ArrayHelper::map($modelsBahan, 'id', 'id')));
            $invoice->total_biaya=0;
            $invoice->save();
            // validate all models
            $valid = $invoice->validate();
            $valid = Model::validateMultiple($modelsBahan) && $valid;

            if ($valid) {
                $transaction = \Yii::$app->db->beginTransaction();
                try {
                    if ($flag = $invoice->save(false)) {
                        if (!empty($deletedIDs)) {
                            RekapitulasiBahan::deleteAll(['id' => $deletedIDs]);
                        }
                        foreach ($modelsBahan as $modelBahan) {
                            $modelBahan->id_peneliti = $model->id;
                            $invoice->total_biaya += $modelBahan->harga;
                            if (! ($flag = $modelBahan->save(false))) {
                                $transaction->rollBack();
                                break;
                            }
                        }
                    }
                    if ($flag) {
                        $invoice->save();
                        $transaction->commit();
                        return $this->redirect(['view', 'id' => $model->id]);
                    }
                } catch (Exception $e) {
                    $transaction->rollBack();
                }
            }
        }

        return $this->render('updateInvoice', [
            'model' => $model,
            'invoice' => $invoice,
            'modelsBahan' => (empty($modelsBahan)) ? [new RekapitulasiBahan] : $modelsBahan,
        ]);
    }

    public function actionInvoicePdf($id) {
    // get your HTML raw content without any layouts or scripts
        $model = $this->findModel($id);
        $invoice = Invoice::findOne(['id_peneliti' => $model->id]);
        $rekapitulasiBahan = RekapitulasiBahan::findAll(['id_peneliti' => $model->id]);
        $content = $this->renderPartial('invoicePdf', [
            'model' => $model,
            'invoice' => $invoice,
            'rekapitulasiBahan' => $rekapitulasiBahan,
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

            'filename' => $invoice->no_invoice,
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>null, 
                'SetFooter'=>null,
            ]   
        ]);
 
    // return the pdf output as per the destination setting
        return $pdf->render();
    } 

    public function actionCreateKwitansi($id)
    {
        $this->checkPrivilege();
        $model = $this->findModel($id);
        $kwitansi = new Kwitansi();
        $invoice = Invoice::findOne(['id_peneliti' => $model->id]);

        if ($kwitansi->load(Yii::$app->request->post())) {
            $kwitansi->no_kwitansi .= '/I3.11.8/KW/2017';
            $kwitansi->id_peneliti = $model->id;
            $kwitansi->save();
            // var_dump($kwitansi->validate());die;
            return $this->redirect(['view', 'id'=> $model->id]);
        } else {
            return $this->renderAjax('createKwitansi', [
                'model' => $model,
                'kwitansi' => $kwitansi,
            ]);
        }
    }

    /**
     * Updates an existing Supplier model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdateKwitansi($id)
    {
        $this->checkPrivilege();
        $model = $this->findModel($id);
        $kwitansi = Kwitansi::findOne(['id_peneliti' => $model->id]);
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('updateKwitansi', [
                'model' => $model,
                'kwitansi' => $kwitansi,
            ]);
        }
    }

    public function actionKwitansiPdf($id) {
    // get your HTML raw content without any layouts or scripts
        $model = $this->findModel($id);
        $kwitansi = Kwitansi::findOne(['id_peneliti' => $model->id]);
        $invoice = Invoice::findOne(['id_peneliti' => $model->id]);
        $content = $this->renderPartial('kwitansiPdf', [
            'model' => $model,
            'kwitansi' => $kwitansi,
            'invoice' => $invoice,
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

            'filename' => $kwitansi->no_kwitansi,
             // call mPDF methods on the fly
            'methods' => [ 
                'SetHeader'=>null, 
                'SetFooter'=>null,
            ]   
        ]);
 
    // return the pdf output as per the destination setting
        return $pdf->render();
    } 

    protected function findModel($id)
    {
        if (($model = Peneliti::findOne($id)) != null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }

    public function checkPrivilege() {
        if (Yii::$app->user->isGuest) throw new \yii\web\HttpException(403, 'You don\'t have permission to access this page.');
    }
}
