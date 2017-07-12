<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\PenelitiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peneliti-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'nama_lengkap') ?>

    <?= $form->field($model, 'tempat_tanggal_lahir') ?>

    <?= $form->field($model, 'institusi') ?>

    <?= $form->field($model, 'departemen_id') ?>

    <?php // echo $form->field($model, 'nrp_nim') ?>

    <?php // echo $form->field($model, 'no_handphone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'alamat_dan_no_telp_bogor') ?>

    <?php // echo $form->field($model, 'alamat_dan_no_telp_orang_tua') ?>

    <?php // echo $form->field($model, 'judul_penelitian') ?>

    <?php // echo $form->field($model, 'tanggal_masuk_lpsb') ?>

    <?php // echo $form->field($model, 'uang_masuk_lpsb') ?>

    <?php // echo $form->field($model, 'deposit_lpsb') ?>

    <?php // echo $form->field($model, 'keterangan') ?>

    <?php // echo $form->field($model, 'biaya_hasil_rekapitulasi') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
