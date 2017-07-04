<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysisRequestSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="analysis-request-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'status_pengujian') ?>

    <?= $form->field($model, 'tanggal_diterima') ?>

    <?= $form->field($model, 'tanggal_selesai') ?>

    <?= $form->field($model, 'total_biaya') ?>

    <?php // echo $form->field($model, 'dp') ?>

    <?php // echo $form->field($model, 'sisa') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
