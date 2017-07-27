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
    <div class="panel-heading"><h4><i class="fa fa-archive"></i> Invoice </h4> 
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
                    <?= $form->field($invoice, 'no_invoice')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-6">
                    <?= $form->field($invoice, 'tanggal_penerbitan_invoice')->widget(DatePicker::classname(), [
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
    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 99, // the maximum times, an element can be cloned (default 999)
        'min' => \Yii::$app->params['itemMinimal'], // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsSampelInvoice[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'sampel',
            'kode',
            'analisis',
            'jumlah',
            'harga',
        ],
    ]); ?>
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="fa fa-flask"></i> Sampel <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Sampel </button> </h4> 
            <div class="clearfix"></div>
            </div>
            <div class="panel-body">

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsSampelInvoice as $i => $modelSampelInvoice): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Sampel Invoice</h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelSampelInvoice->isNewRecord) {
                                echo Html::activeHiddenInput($modelSampelInvoice, "[{$i}]sampel");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelSampelInvoice, "[{$i}]sampel")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelSampelInvoice, "[{$i}]kode")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <!-- .row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelSampelInvoice, "[{$i}]analisis")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelSampelInvoice, "[{$i}]jumlah")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($modelSampelInvoice, "[{$i}]harga")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-3">
            <?= $form->field($invoice, 'total_biaya')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-sm-9">
            <?= $form->field($invoice, 'terbilang')->textInput(['maxlength' => true]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton($invoice->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div></div></div>
</div>
