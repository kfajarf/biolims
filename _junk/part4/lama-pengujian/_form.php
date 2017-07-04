<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LamaPengujian */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lama-pengujian-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status_pengujian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_diterima')->textInput() ?>

    <?= $form->field($model, 'tanggal_selesai')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
