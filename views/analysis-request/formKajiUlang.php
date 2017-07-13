<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\LabKit */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="row">
	<div class="col-md-10">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'enableAjaxValidation' => true]); ?>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => \Yii::$app->params['kajiUlangParamLimit'], // the maximum times, an element can be cloned (default 999)
        'min' => \Yii::$app->params['itemMinimal'], // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $kajiUlang[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'parameter',
            'metode',
            'peralatan',
            'personel',
            'bahan_kimia',
            'kondisi_akomodasi',
            'kesimpulan',
        ],
    ]); ?>
        <div class="panel panel-default">
            <div class="panel-heading"><h4><i class="fa fa-flask"></i> Parameter <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Parameter </button> </h4> 
                <div class="clearfix"></div>
            </div>
            <div class="panel-body">

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($kajiUlang as $i => $kajiUlangItem): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Sampel</h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $kajiUlangItem->isNewRecord) {
                                echo Html::activeHiddenInput($kajiUlangItem, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($kajiUlangItem, "[{$i}]parameter")->textInput(['maxlength' => true]) ?>
                            </div>
                            <!-- <div class="col-md-6">
                                <?= $form->field($kajiUlangItem, "[{$i}]kesimpulan")->textarea(['rows' => 1]) ?>
                            </div> -->
                        </div>
                        <div class="row">
                            <div class="col-sm-2">
                                <?= $form->field($kajiUlangItem, "[{$i}]metode")->dropDownList([1 => 'Bisa', 0 => 'Tidak Bisa']) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($kajiUlangItem, "[{$i}]peralatan")->dropDownList([1 => 'Bisa', 0 => 'Tidak Bisa']) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($kajiUlangItem, "[{$i}]personel")->dropDownList([1 => 'Bisa', 0 => 'Tidak Bisa']) ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($kajiUlangItem, "[{$i}]bahan_kimia")->dropDownList([1 => 'Bisa', 0 => 'Tidak Bisa']) ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($kajiUlangItem, "[{$i}]kondisi_akomodasi")->dropDownList([1 => 'Bisa', 0 => 'Tidak Bisa']) ?>
                            </div>  
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
		    <div class="form-group">
		        <?= Html::submitButton('Create', ['class' => 'btn btn-success']) ?>
		    </div>
            </div>
        </div>
    <?php DynamicFormWidget::end(); ?>


    <?php ActiveForm::end(); ?>
    </div>
</div>
