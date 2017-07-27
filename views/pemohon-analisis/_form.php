<?php

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
    <div class="panel-heading"><h4><i class="fa fa-user"></i> LPSB Sample Analysis </h4> 
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'enableAjaxValidation' => true]); ?>

    <?= $form->field($model, 'lpsb_order_no')->textInput(['maxlength' => true]) ?>

    <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="fa fa-user"></i> Pemohon Analisis </h4> 
            <div class="clearfix"></div>
        </div>
        <div class="panel-body">
        <div class="row">
            <div class="col-sm-8">
                <?= $form->field($pemohon, 'nama_lengkap')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-4">
                <?= $form->field($pemohon, 'email')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <?= $form->field($pemohon, 'institusi_perusahaan')->textInput(['maxlength' => true]) ?>
        <div class="row">
            <div class="col-sm-6">
                <?= $form->field($pemohon, 'telp_fax')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-6">
                <?= $form->field($pemohon, 'no_hp')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <?= $form->field($pemohon, 'alamat')->textarea(['rows' => 3]) ?>
        </div>
    </div>
    
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'status_pengujian')->dropDownList([ 'biasa' => 'Biasa', 'percepatan' => 'Percepatan', ], ['prompt' => '-- Lama  Pengujian --']) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'tanggal_diterima')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => '-- 2017/12/31 --'],
            'pluginOptions' => [
                    'startDate' => date('Y-m-d'),
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    ]
            ]) ?>
        </div>
        <div class="col-sm-5">
            <?= $form->field($model, 'tanggal_selesai')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => '-- 2017/12/31 --'],
            'pluginOptions' => [
                    'startDate' => date('Y-m-d'),
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    ]
            ]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-6">
            <?= $form->field($model, 'total_biaya')->textInput() ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($model, 'dp')->textInput() ?>
        </div>
    </div>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 3]) ?>
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>

</div>
    </div>
</div>
