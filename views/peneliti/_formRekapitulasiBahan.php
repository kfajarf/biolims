<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;
use app\models\Departemen;

/* @var $this yii\web\View */
/* @var $model app\models\Peneliti */
/* @var $form yii\widgets\ActiveForm */
// var_dump(\Yii::$app->controller->action->id);die();
?>

<div class="row">
    <div class="col-md-10">
<div class="analysis-request-form">

<div class="panel panel-default">
    <div class="panel-heading"><h4><i class="fa fa-flask"></i> Rekapitulasi Bahan </h4> 
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">


    <div class="row">
        <div class="col-md-12">
    <?php $form = ActiveForm::begin([
        'id' => 'rekap-bahan',
        // 'enableAjaxValidation' => false,
    ]); ?>

        <div class="row">
            <div class="col-md-12">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 15, // the maximum times, an element can be cloned (default 999)
                    'min' => \Yii::$app->params['itemMinimal'], // 0 or 1 (default 1)
                    'insertButton' => '.add-item', // css class
                    'deleteButton' => '.remove-item', // css class
                    'model' => $modelsBahan[0],
                    'formId' => 'rekap-bahan',
                    'formFields' => [
                        'id',
						'nama_bahan',
						'spesifikasi',
						'jumlah',
						'harga',
						'keterangan',
                    ],
                ]); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4><i class="fa fa-flask"></i> Bahan <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Bahan </button> </h4> 
                        <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">

                        <div class="container-items"><!-- widgetContainer -->
                        <?php foreach ($modelsBahan as $i => $modelBahan): ?>
                            <div class="item panel panel-default"><!-- widgetBody -->
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Data</h3>
                                    <div class="pull-right">
                                        <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <?php
                                        // necessary for update action.
                                        if (! $modelBahan->isNewRecord) {
                                            echo Html::activeHiddenInput($modelBahan, "[{$i}]id");
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

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($label, ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div></div></div>
</div>

