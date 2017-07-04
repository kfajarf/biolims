<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysisRequest */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
    <div class="col-md-6">
<div class="analysis-request-form">
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'lpsb_order_no')->textInput(['maxlength' => true]) ?>

    <?= $form->field($pemohon, 'nama')->textInput(['maxlength' => true]) ?>

    <?= $form->field($pemohon, 'institusi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($pemohon, 'alamat')->textarea(['rows' => 3]) ?>

    <?= $form->field($pemohon, 'telp_fax')->textInput(['maxlength' => true]) ?>

    <?= $form->field($pemohon, 'no_hp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($pemohon, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($sampel, 'id_sampel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($sampel, 'nama_sampel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($sampel, 'jenis_sampel')->textInput(['maxlength' => true]) ?>

    <?= $form->field($sampel, 'kemasan')->textInput(['maxlength' => true]) ?>

    <?= $form->field($sampel, 'jumlah')->textInput() ?>

    <?= $form->field($sampel, 'jenis_metode_analisis')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_pengujian')->textInput() ?>

    <?= $form->field($model, 'total_biaya')->textInput() ?>

    <?= $form->field($model, 'dp')->textInput() ?>

    <?= $form->field($model, 'sisa')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
    </div>
</div>
