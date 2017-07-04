<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use app\models\Lokasi;
use app\models\Supplier;
use kartik\date\DatePicker;

/* @var $this yii\web\View */
/* @var $model app\models\ChemStorage */
/* @var $form yii\widgets\ActiveForm */
?>
<div class="row">
    <div class="col-md-10">
<div class="analysis-request-form">

<div class="panel panel-default">
    <div class="panel-heading"><h4><i class="fa fa-user"></i> Identitas </h4> 
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">

    <?php $form = ActiveForm::begin([
    	'id' => 'dynamic-form',
        // 'enableAjaxValidation' => true,
	]); ?>

    <div class="row">
    	<div class="col-md-12">
    <?= $form->field($model, 'pemilik')->textInput(['maxlength' => true]) ?>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
        'widgetBody' => '.container-items', // required: css class selector
        'widgetItem' => '.item', // required: css class
        'limit' => 99, // the maximum times, an element can be cloned (default 999)
        'min' => \Yii::$app->params['itemMinimal'], // 0 or 1 (default 1)
        'insertButton' => '.add-item', // css class
        'deleteButton' => '.remove-item', // css class
        'model' => $modelsReagen[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'id',
            'nama_reagen',
            'jenis_reagen',
            'jumlah',
            'jumlah_minimum',
            'unit',
            'tanggal_kadaluarsa',
            'status',
            'id_lokasi',
            'id_supplier'
        ],
    ]); ?>
	    <div class="panel panel-default">
	        <div class="panel-heading"><h4><i class="fa fa-flask"></i> Reagen <button type="button" class="pull-right add-item btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Reagen </button> </h4> 
	        <div class="clearfix"></div>
	        </div>
	        <div class="panel-body">

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($modelsReagen as $i => $modelReagen): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Reagen</h3>
                        <div class="pull-right">
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $modelReagen->isNewRecord) {
                                echo Html::activeHiddenInput($modelReagen, "[{$i}]id");
                            }
                        ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($modelReagen, "[{$i}]id")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($modelReagen, "[{$i}]nama_reagen")->textInput(['maxlength' => true]) ?>
                            </div>
                        </div>
                        <!-- .row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($modelReagen, "[{$i}]jenis_reagen")->dropDownList([ 'padat' => 'Padat', 'cair' => 'Cair', ], ['prompt' => 'Pilih Jenis Reagen']) ?>
                            </div>
                        	<div class="col-sm-4">
                        		<?= $form->field($modelReagen, "[{$i}]id_lokasi")->dropDownList(
                					ArrayHelper::map(Lokasi::find()->all(), 'id', 'lokasi_penyimpanan'), ['prompt' => 'Pilih Lokasi Penyimpanan']
            					) ?>
                        	</div>
                        	<div class="col-sm-4">
                        		<?= $form->field($modelReagen, "[{$i}]id_supplier")->dropDownList(
                					ArrayHelper::map(Supplier::find()->all(), 'id', 'supplier'), ['prompt' => 'Pilih Supplier']
            					) ?>
                        	</div>
                        </div><!-- row -->
                        <div class="row">
                            <div class="col-sm-2">
                                <?= $form->field($modelReagen, "[{$i}]jumlah")->textInput() ?>
                            </div>
                            <div class="col-sm-2">
                                <?= $form->field($modelReagen, "[{$i}]jumlah_minimum")->textInput() ?>
                            </div>
                            <div class="col-sm-3">
                                <?= $form->field($modelReagen, "[{$i}]unit")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-5">
                                <?= $form->field($modelReagen, "[{$i}]tanggal_kadaluarsa")->widget(DatePicker::classname(), [
                                    'options' => ['placeholder' => 'Masukkan Tanggal Kadaluarsa'],
    								'pluginOptions' => [
                                        'startDate' => date('Y-m-d'),
                                        'autoclose'=>true,
                                        'format' => 'yyyy-mm-dd',
                                        'todayHighlight' => true,
                                        ]
                                	]) 
                                ?>
                            </div>
                        </div><!-- .row -->
                    </div>
                </div>
            <?php endforeach; ?>
            </div>
        </div>
    </div>
    <?php DynamicFormWidget::end(); ?>
    	</div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div></div></div>
</div>
