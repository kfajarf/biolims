<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\LabKit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-kit-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_alat')->textInput(['maxlength' => true]) ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($model, 'tanggal_mulai')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Masukkan Tanggal Awal Kalibrasi'],
                'pluginOptions' => [
                    'startDate' => date('Y-m-d'),
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    ]
                ]) 
            ?>
        </div>
        <div class="col-md-6 pull-right">
            <?= $form->field($model, 'jangka_kalibrasi')->textInput() ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <div class="form-group">
                <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-md-6 pull-right">
            *kalibrasi dilakukan dalam berapa minggu sekali
        </div>
    </div>
    <!-- <?= $form->field($model, 'status_penggunaan')->dropDownList([ 'digunakan' => 'Digunakan', 'tersedia' => 'Tersedia', ], ['prompt' => '']) ?> -->

    <?php ActiveForm::end(); ?>

</div>
