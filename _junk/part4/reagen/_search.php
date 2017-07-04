<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ReagenSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reagen-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id_bahan') ?>

    <?= $form->field($model, 'nama_bahan') ?>

    <?= $form->field($model, 'jenis_bahan') ?>

    <?= $form->field($model, 'jumlah') ?>

    <?= $form->field($model, 'jumlah_minimum') ?>

    <?php // echo $form->field($model, 'unit') ?>

    <?php // echo $form->field($model, 'tanggal_kadaluarsa') ?>

    <?php // echo $form->field($model, 'id_lokasi') ?>

    <?php // echo $form->field($model, 'id_supplier') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'id_storage') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
