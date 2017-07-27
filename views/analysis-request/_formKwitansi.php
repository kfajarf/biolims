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
<div class="row">
    <div class="col-md-10">
<div class="form">

<div class="panel panel-default">
    <div class="panel-heading"><h4><i class="fa fa-archive"></i> Kwitansi </h4> 
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">

    <?php $form = ActiveForm::begin([
        'id' => 'dynamic-form',
        // 'enableAjaxValidation' => true,
    ]); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-sm-6">
            		<?= $form->field($kwitansi, 'no_kwitansi')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-6">
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
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($kwitansi, 'jumlah_biaya')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-9">
            <?= $form->field($kwitansi, 'terbilang')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <?= $form->field($kwitansi, 'telah_terima_dari')->textInput(['maxlength' => true]) ?>
		</div>
        <!-- <div class="col-sm-9">
            <?= $form->field($kwitansi, 'untuk_pembayaran_analisis')->textInput(['maxlength' => true]) ?>
       	</div> -->
    </div>
    <div class="form-group">
        <?= Html::submitButton($kwitansi->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div></div></div>
</div>
