<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\SampelSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="sampel-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'nama_sampel') ?>

    <?= $form->field($model, 'jenis') ?>

    <?= $form->field($model, 'kemasan') ?>

    <?= $form->field($model, 'jumlah') ?>

    <?= $form->field($model, 'jenis_metode_analisis') ?>

    <?php // echo $form->field($model, 'lpsb_order_no') ?>

    <?php // echo $form->field($model, 'id_pemohon') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
