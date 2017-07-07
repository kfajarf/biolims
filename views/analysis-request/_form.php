<?php

namespace app\models;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysisRequest */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-10">
<div class="analysis-request-form">

<div class="panel panel-default">
    <div class="panel-heading"><h4><i class="fa fa-user"></i> LPSB Analisis Sampel </h4> 
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'enableAjaxValidation' => true]); ?>

    <div class="row">
            <div class="col-sm-5">
                <?= $form->field($model, 'lpsb_order_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'id_kategori_klien')->textInput(['maxlength' => true])->dropDownList(
                    ArrayHelper::map(KategoriKlien::find()->all(), 'id', 'kategori'), ['prompt' => 'Pilih Kategori']
                    ) 
                ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($model, 'tanggal_diterima')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => '-- Tanggal Selesai --'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        ]
                    ]) 
                ?>
            </div>
        </div>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="fa fa-user"></i> Pemohon Analisis </h4> 
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
        <div class="row">
            <div class="col-sm-5">
                <?= $form->field($pemohon, 'nama_lengkap')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($pemohon, 'institusi_perusahaan')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($pemohon, 'email')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-8">
                <?= $form->field($pemohon, 'alamat')->textarea(['rows' => 1]) ?>
            </div>        
            <div class="col-sm-2">
                <?= $form->field($pemohon, 'telp_fax')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-2">
                <?= $form->field($pemohon, 'no_hp')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        </div>
    </div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => \Yii::$app->params['itemLimit'], // the maximum times, an element can be cloned (default 999)
        'min' => \Yii::$app->params['itemMinimal'], // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsSampel[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'nama_sampel',
            'jenis',
            'kemasan',
            'jumlah',
            'jenis_metode_analisis',
        ],
    ]); ?>
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="fa fa-flask"></i> Sampel <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Sampel </button> </h4> 
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsSampel as $i => $modelSampel): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Sampel </h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelSampel->isNewRecord) {
                                echo Html::activeHiddenInput($modelSampel, "[{$i}]nama_sampel");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-2">
                                <?= $form->field($modelSampel, "[{$i}]sampel_id")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelSampel, "[{$i}]nama_sampel")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelSampel, "[{$i}]kemasan")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelSampel, "[{$i}]jumlah")->textInput(['maxlength' => true]) ?>
                            </div>    
                        </div> 
                        <div class="row">
                            <div class="col-sm-3">
                                <?= $form->field($modelSampel, "[{$i}]id_jenis")->textInput(['maxlength' => true])->dropDownList(
                                        ArrayHelper::map(JenisAnalisis::find()->all(), 'id', 'jenis'), ['prompt' => 'Jenis Analisis']
                                    ) 
                                ?>
                            </div>
                            <div class="col-sm-9">
                            <?= $form->field($modelSampel, "[{$i}]jenis_metode_analisis")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
            </div>
        </div>
    <?php DynamicFormWidget::end(); ?>   
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'status_pengujian')->dropDownList([ 'biasa' => 'Biasa', 'percepatan' => 'Percepatan', ], ['prompt' => '--Pengujian--']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'tanggal_selesai')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => '-- Tanggal Selesai --'],
            'pluginOptions' => [
                'startDate' => date('Y-m-d'),
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                ]
            ]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'total_biaya')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'dp')->textInput() ?>
        </div>
    </div>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 2]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>

</div>
    </div>
</div>
