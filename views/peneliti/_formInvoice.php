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
                    'limit' => 15, // the maximum times, an element can be cloned (default 999)
                    'min' => \Yii::$app->params['itemMinimal'], // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsBahan[0],
                    'formId' => 'dynamic-form',
                    'formFields' => [
                        'nama_bahan',
                        'spesifikasi',
                        'jumlah',
                        'harga',
                        'keterangan',
                    ],
                ]); ?>
                    <div class="panel panel-default">
                        <div class="panel-body">

                        <div class="container-items"><!-- widgetContainer -->
                        <?php foreach ($modelsBahan as $i => $modelBahan): ?>
                            <div class="item panel panel-default"><!-- widgetBody -->
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Data</h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <?php
                                        // necessary for update action.
                                        if (! $modelBahan->isNewRecord) {
                                            echo Html::activeHiddenInput($modelBahan, "[{$i}]nama_bahan");
                                        }
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <?= $form->field($modelBahan, "[{$i}]nama_bahan")->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <?= $form->field($modelBahan, "[{$i}]jumlah")->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <div class="col-sm-2">
                                            <?= $form->field($modelBahan, "[{$i}]spesifikasi")->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <?php if(\Yii::$app->controller->action->id == 'create-invoice' || \Yii::$app->controller->action->id == 'update-invoice'):?>
                                        <div class="col-sm-2">
                                            <?= $form->field($modelBahan, "[{$i}]harga")->textInput(['maxlength' => true]) ?>
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?= $form->field($modelBahan, "[{$i}]keterangan")->textInput(['maxlength' => true]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                        </div>
                    </div>
                </div>
                <?php DynamicFormWidget::end(); ?>
        </div>
    </div>
    <!-- /////////// -->

    <!-- /////// -->
    <div class="form-group">
        <?= Html::submitButton($invoice->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div></div></div>
</div>
