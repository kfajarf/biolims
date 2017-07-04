<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use app\models\LabKit;

/* @var $this yii\web\View */
/* @var $model app\models\PenggunaanAlat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="penggunaan-alat-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-md-7">
        <?= $form->field($pengguna, 'nama_pengguna')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-5">
        <?= $form->field($pengguna, 'nim')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-md-6">
            <?= $form->field($pengguna, 'kit_id')->dropDownList(
                ArrayHelper::map(LabKit::find()->where(['not', ['id' => NULL]])->all(), 'id', 'nama_alat'), ['prompt' => 'Pilih Alat']
            ) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($pengguna, 'tanggal_penggunaan')->widget(DatePicker::classname(), [
                'options' => ['placeholder' => 'Masukkan tanggal'],
                'pluginOptions' => [
                    'startDate' => date('Y-m-d'),
                    'autoclose'=>true,
                    'format' => 'yyyy-mm-dd',
                    'todayHighlight' => true,
                    ]
                ]) 
            ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($pengguna->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
