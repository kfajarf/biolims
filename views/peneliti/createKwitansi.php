<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ChemStorage */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="surat-keluar-form">

    <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form',
        // 'enableAjaxValidation' => true,
    ]); ?>

	<?= $form->field($kwitansi, 'no_kwitansi')->textInput(['maxlength' => true]) ?>

    <?= $form->field($kwitansi, 'tanggal_kwitansi')->widget(DatePicker::classname(), [
        'options' => ['placeholder' => '-- 2017/12/31 --'],
        'pluginOptions' => [
            'startDate' => date('Y-m-d'),
            'autoclose'=>true,
            'format' => 'yyyy-mm-dd',
            'todayHighlight' => true,
            ]
        ])
    ?>
    <div class="form-group">
        <?= Html::submitButton($kwitansi->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div>
    </div>
</div>
    