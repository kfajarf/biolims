<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Peneliti */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="peneliti-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tempat_tanggal_lahir')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'institusi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'nrp_nim')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'no_handphone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_dan_no_telp_bogor')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'alamat_dan_no_telp_orang_tua')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'judul_penelitian')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'tanggal_masuk_lpsb')->textInput() ?>

    <?= $form->field($model, 'uang_masuk_lpsb')->textInput() ?>

    <?= $form->field($model, 'deposit_lpsb')->textInput() ?>

    <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'biaya_hasil_rekapitulasi')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
