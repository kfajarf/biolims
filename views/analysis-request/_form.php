<?php

namespace app\models;

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\date\DatePicker;

?>

<div class="row">
    <div class="col-md-12">
<div class="analysis-request-form">

<!-- The LPSB Order Information    -->
<div class="panel panel-default">
    <div class="panel-heading"><h4><i class="fa fa-user"></i> LPSB Analisis Sampel </h4> 
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
    <?php $form = ActiveForm::begin(['id' => 'dynamic-form', 'enableAjaxValidation' => false]); ?>
    
        <div class="row">
            <div class="col-sm-5">
                <?= $form->field($model, 'lpsb_order_no')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-sm-3">
                <?= $form->field($model, 'id_kategori_klien')->textInput(['maxlength' => true])->dropDownList(
                    ArrayHelper::map(KategoriKlien::find()->all(), 'id', 'kategori'), ['prompt' => 'Pilih Kategori']
                    ) 
                ?>
            </div>
            
            <div class="col-sm-4">
                <?= $form->field($model, 'tanggal_diterima')->widget(DatePicker::classname(), [
                    'options' => ['placeholder' => '-- Tanggal Selesai --'],
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'yyyy-mm-dd',
                        'todayHighlight' => true,
                        ]
                    ]) 
                ?>
            </div>
        </div>

        <div class="line" style="padding: 0px" align="center"><h4><b>Pengirim</b></h4></div>
            <div class="panel-body">
            <div class="row">
                <div class="col-sm-5">
                    <?= $form->field($pemohon, 'nama_lengkap')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-4">
                    <?= $form->field($pemohon, 'institusi_perusahaan')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-3">
                    <?= $form->field($pemohon, 'email')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    <?= $form->field($pemohon, 'alamat')->textarea(['rows' => 1]) ?>
                </div>        
                <div class="col-sm-2">
                    <?= $form->field($pemohon, 'telp_fax')->textInput(['maxlength' => true]) ?>
                </div>
                <div class="col-sm-2">
                    <?= $form->field($pemohon, 'no_hp')->textInput(['maxlength' => true]) ?>
                </div>
            </div>
            </div>


<!-- //////////////////////////////////// -->

        <div class="line" style="padding: 0px" align="center"><h4><b>Daftar Sampel</b></h4></div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.kAnalisis-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-kAnalisis',
        'deleteButton' => '.remove-kAnalisis',
        'model' => $modelsKAnalisis[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'description',
        ],
    ]); ?>
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th style="width: 20%;">Jenis Metode Analisis</th>
                <th style="width: 70%;">Sampel</th>
                <th class="text-center" style="width: 10%;">
                    <button type="button" class="add-kAnalisis btn btn-success btn-xs"><span class="fa fa-plus"></span></button>
                </th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($modelsKAnalisis as $indexAnalisis => $modelKAnalisis): ?>
            <tr class="kAnalisis-item">
                <td class="vcenter">
                    <?php
                        // necessary for update action.
                        if (! $modelKAnalisis->isNewRecord) {
                            echo Html::activeHiddenInput($modelKAnalisis, "[{$indexAnalisis}]id");
                        }
                    ?>
                    <?= $form->field($modelKAnalisis, "[{$indexAnalisis}]analisis")->textInput(['maxlength' => true])->widget(\yii\jui\AutoComplete::classname(), [
                            'options' => ['placeholder' => '', 'class' => 'form-control'],
                            'clientOptions' =>  [
                                'source' => ArrayHelper::getColumn(JenisAnalisis::find()->all(), 'jenis'),  ],
                            ]
                        )
                    ?>
                    <?= $form->field($modelKAnalisis, "[{$indexAnalisis}]metode")->textInput(['maxlength' => true, 'placeholder' => ''
                    ]) ?>
                </td>
                <td>
                    <?= $this->render('_formSampel', [
                        'form' => $form,
                        'indexAnalisis' => $indexAnalisis,
                        'modelsSampel' => $modelsSampel[$indexAnalisis],
                    ]) ?>
                </td>
                <td class="text-center vcenter" style="width: 90px; vertical-align: center">
                    <button type="button" class="remove-kAnalisis btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>
    <?php DynamicFormWidget::end(); ?>
    <div class="row">
        <div class="col-sm-2">
            <?= $form->field($model, 'status_pengujian')->dropDownList([ 'biasa' => 'Biasa', 'percepatan' => 'Percepatan', ], ['prompt' => '--Pengujian--']) ?>
        </div>
        <div class="col-sm-4">
            <?= $form->field($model, 'tanggal_selesai')->widget(DatePicker::classname(), [
            'options' => ['placeholder' => '-- Tanggal Selesai --'],
            'pluginOptions' => [
                'autoclose'=>true,
                'format' => 'yyyy-mm-dd',
                'todayHighlight' => true,
                ]
            ]) ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'total_biaya')->textInput() ?>
        </div>
        <div class="col-sm-3">
            <?= $form->field($model, 'dp')->textInput() ?>
        </div>
    </div>
    <?= $form->field($model, 'keterangan')->textarea(['rows' => 2]) ?>
    
    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => 'btn btn-primary']) ?>
    </div>    

    <?php ActiveForm::end(); ?>
    </div>
</div>

</div>
    </div>
</div>  