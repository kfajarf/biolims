<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model app\models\SuratMasuk */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row" style="padding: 15px">
    <div class="line col-md-10" style="overflow-x: hidden; padding: 20px">
<div class="surat-masuk-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-12">
            <?= $form->field($model, 'nomor_surat')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tanggal_surat')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => '-- 2017/12/31 --'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                    ]
                ]) 
            ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'tanggal_terima')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => '-- 2017/12/31 --'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                    ]
                ]) 
            ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'sumber_surat')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($model, 'perihal')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-9 pull-right">
            <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>
            <?php if(!$model->isNewRecord):?>
            <?= Html::a('Download file', ['download', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
            <?php endif;?>
        </div>
        <div class="col-md-3">   
            <?= $form->field($model, 'file_surat')->fileInput() ?>
        </div>
    </div>    
        <div class="form-group"> 
            <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>
    </div>
</div>
</div>
