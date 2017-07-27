<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Lokasi;
use app\models\Supplier;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\Reagen */
/* @var $form yii\widgets\ActiveForm */
?>
<div class= "row" style="padding: 15px">
    <div class="col-md-10" style="border-top: 7px solid rgba(0, 100, 170, 1); overflow-x: auto; white-space: nowrap; background-color: white; padding: 20px 20px 0px 20px">
<div class="reagen-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($reagen, 'id_reagen')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($reagen, 'nama_reagen')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <?= $form->field($reagen, 'jenis_reagen')->dropDownList([ 'padat' => 'Padat', 'cair' => 'Cair'], ['prompt' => 'Pilih Jenis Reagen']) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($reagen, 'id_lokasi')->dropDownList(
                ArrayHelper::map(Lokasi::find()->all(), 'id', 'lokasi_penyimpanan'), ['prompt' => 'Pilih Lokasi Penyimpanan']
            ) ?>
        </div>
        <div class="col-md-4">
            <?= $form->field($reagen, 'id_supplier')->dropDownList(
                ArrayHelper::map(Supplier::find()->all(), 'id', 'supplier'), ['prompt' => 'Pilih Supplier']
            ) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-2">
            <?= $form->field($reagen, 'jumlah')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($reagen, 'jumlah_minimum')->textInput() ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($reagen, 'unit')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($reagen, "suhu_penyimpanan")->dropDownList([ 'Room Temperature' => 'Room Temperature', '-2 Celsius' => '-2 Celsius', '-20 Celsius' => '-20 Celsius'], ['prompt' => 'Suhu Penyimpanan']) ?>
        </div>
        <div class="col-md-3">
            <?= $form->field($reagen, 'tanggal_kadaluarsa')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => '-- 2017/12/31 --'],
                'pluginOptions' => [
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd'
                    ]
                ]) 
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($reagen->isNewRecord ? 'Create' : 'Update', ['class' => $reagen->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
    </div>
</div>
