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
?>

<div class="row">
    <div class="col-md-10">
<div class="analysis-request-form">

<div class="panel panel-default">
    <div class="panel-heading"><h4><i class="fa fa-user"></i> Identitas </h4> 
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">


    <div class="row">
        <div class="col-md-12">
    <?php $form = ActiveForm::begin([
        'id' => 'peneliti-form',
        'enableAjaxValidation' => false,
    ]); 
        $departemen = Departemen::find()->all();
    ?>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'nama_lengkap')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'tempat_tanggal_lahir')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'institusi')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'departemen_id')->dropDownList(
                        ArrayHelper::map($departemen, 'id', function($departemen) {
                            return $departemen->kode_nim. ' - ' . $departemen->nama_departemen;
                        }), ['prompt' => '-- Departemen --']
                    ) 
                ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'nrp_nim')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $form->field($model, 'no_handphone')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-md-6">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        <?= $form->field($model, 'alamat_dan_no_telp_bogor')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'alamat_dan_no_telp_orang_tua')->textInput(['maxlength' => true]) ?>

        <div class="row">
            <div class="col-md-6">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.container-items', // required: css class selector
                    'widgetItem' => '.item', // required: css class
                    'limit' => 3, // the maximum times, an element can be cloned (default 999)
                    'min' => \Yii::$app->params['itemMinimal'], // 0 or 1 (default 1)
                    'insertButton' => '.add-pembimbing', // css class
                    'deleteButton' => '.remove-pembimbing', // css class
                    'model' => $modelsPembimbing[0],
                    'formId' => 'peneliti-form',
                    'formFields' => [
                        'id',
                        'nama_pembimbing'
                    ],
                ]); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4><i class="fa fa-user"></i> Pembimbing <button type="button" class="pull-right add-pembimbing btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Pembimbing </button> </h4> 
                        <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">

                        <div class="container-items"><!-- widgetContainer -->
                        <?php foreach ($modelsPembimbing as $i => $modelPembimbing): ?>
                            <div class="item panel panel-default"><!-- widgetBody -->
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Data</h3>
                                    <div class="pull-right">
                                        <button type="button" class="remove-pembimbing btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <?php
                                        // necessary for update action.
                                        if (! $modelPembimbing->isNewRecord) {
                                            echo Html::activeHiddenInput($modelPembimbing, "[{$i}]id");
                                        }
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?= $form->field($modelPembimbing, "[{$i}]nama_pembimbing")->textInput(['maxlength' => true]) ?>
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
            <div class="col-md-6">
                <?php DynamicFormWidget::begin([
                    'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                    'widgetBody' => '.tempat-items', // required: css class selector
                    'widgetItem' => '.tempat', // required: css class
                    'limit' => 3, // the maximum times, an element can be cloned (default 999)
                    'min' => \Yii::$app->params['itemMinimal'], // 0 or 1 (default 1)
                    'insertButton' => '.add-tempat', // css class
                    'deleteButton' => '.remove-tempat', // css class
                    'model' => $modelsTempat[0],
                    'formId' => 'peneliti-form',
                    'formFields' => [
                        'id',
                        'nama_tempat'
                    ],
                ]); ?>
                    <div class="panel panel-default">
                        <div class="panel-heading"><h4><i class="fa fa-archive"></i> Tempat Penelitian Lain <button type="button" class="pull-right add-tempat btn btn-success btn-xs"><i class="fa fa-plus"></i> Tambah Tempat </button> </h4> 
                        <div class="clearfix"></div>
                        </div>
                        <div class="panel-body">

                        <div class="tempat-items"><!-- widgetContainer -->
                        <?php foreach ($modelsTempat as $idx => $modelTempat): ?>
                            <div class="tempat panel panel-default"><!-- widgetBody -->
                                <div class="panel-heading">
                                    <h3 class="panel-title pull-left">Data</h3>
                                    <div class="pull-right">
                                        <button type="button" class="remove-tempat btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                                    </div>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="panel-body">
                                    <?php
                                        // necessary for update action.
                                        if (! $modelTempat->isNewRecord) {
                                            echo Html::activeHiddenInput($modelTempat, "[{$idx}]id");
                                        }
                                    ?>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <?= $form->field($modelTempat, "[{$idx}]nama_tempat")->textInput(['maxlength' => true]) ?>
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

        <?= $form->field($model, 'judul_penelitian')->textInput(['maxlength' => true]) ?>
        <div class="row">
            <div class="col-md-4">
                <?= $form->field($model, 'tanggal_masuk_lpsb')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => '-- 2017/12/31 --'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        ]
                    ])
                ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'uang_masuk_lpsb')->textInput() ?>
            </div>
            <div class="col-md-4">
                <?= $form->field($model, 'deposit_lpsb')->textInput() ?>
            </div>
        </div>



        <?= $form->field($model, 'keterangan')->textInput(['maxlength' => true]) ?>

        <!-- <?= $form->field($model, 'biaya_hasil_rekapitulasi')->textInput() ?> -->
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>
</div></div></div>
</div>

