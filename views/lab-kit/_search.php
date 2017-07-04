<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\LabKitSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="lab-kit-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nama_alat') ?>

    <?= $form->field($model, 'jangka_kalibrasi') ?>

    <?= $form->field($model, 'tanggal_mulai') ?>

    <?= $form->field($model, 'kalibrasi_selanjutnya') ?>

    <?php // echo $form->field($model, 'status_penggunaan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
