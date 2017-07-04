<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Lokasi;
use app\models\Supplier;
use app\models\Reagen;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\Json;
use yii\widgets\Pjax;
use yii\widgets\Ajax;
use app\models\JenisBahan;

/* @var $this yii\web\View */
/* @var $model app\models\ChemStorage */
/* @var $form yii\widgets\ActiveForm */
?>


<div class="chem-storage-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); 
    ?>

    <?= $form->field($model, 'pemilik')->textInput(['maxlength' => true]) ?>

    <div class="rows">
        <div class="panel panel-default">
        <div class="panel-heading"><h4><i class="fa fa-flask"></i> Reagen </h4></div>
        <div class="panel-body">
            <?php DynamicFormWidget::begin([
                'widgetContainer' => 'dynamicform_wrapper', // required: only alphanumeric characters plus "_" [A-Za-z0-9_]
                'widgetBody' => '.container-items', // required: css class selector
                'widgetItem' => '.item', // required: css class
                'limit' => 4, // the maximum times, an element can be cloned (default 999)
                'min' => 1, // 0 or 1 (default 1)
                'insertButton' => '.add-item', // css class
                'deleteButton' => '.remove-item', // css class
                'model' => $reagen[0],
                'formId' => 'dynamic-form',
                'formFields' => [
                    'id_bahan',
                    'nama_bahan',
                    'jenis_bahan',
                    'jumlah',
                    'jumlah_minimum',
                    'unit',
                    'tanggal_kadaluarsa',
                    'id_lokasi',
                    'id_supplier',
                ],
            ]); ?>

            <div class="container-items"><!-- widgetContainer -->
            <?php foreach ($reagen as $i => $iReagen): ?>
                <div class="item panel panel-default"><!-- widgetBody -->
                    <div class="panel-heading">
                        <h3 class="panel-title pull-left">Reagen</h3>
                        <div class="pull-right">
                            <button type="button" class="add-item btn btn-success btn-xs"><i class="glyphicon glyphicon-plus"></i></button>
                            <button type="button" class="remove-item btn btn-danger btn-xs"><i class="glyphicon glyphicon-minus"></i></button>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-body">
                        <?php
                            // necessary for update action.
                            if (! $iReagen->isNewRecord) {
                                echo Html::activeHiddenInput($iReagen, "[{$i}]id");
                            }
                        ?>
                        <?= $form->field($iReagen, "[{$i}]id_bahan")->textInput(['maxlength' => true]) ?>
                        <div class="row">
                            <div class="col-sm-6">
                                <?= $form->field($iReagen, "[{$i}]nama_bahan")->textInput(['maxlength' => true]) ?>
                            </div>
                            <div class="col-sm-6">
                                <?= $form->field($iReagen, 'jenis_bahan')-> dropDownList(
        							ArrayHelper::map(JenisBahan::find()->all(), 'id_jenis_bahan', 'jenis_bahan'),['prompt' => 'Pilih Jenis Bahan']
        							) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="row">
                            <div class="col-sm-4">
                                <?= $form->field($iReagen, 'jumlah')->textInput() ?>
                            </div>
                            <div class="col-sm-4">                    
                                <?= $form->field($iReagen, 'jumlah_minimum')->textInput() ?>
                            </div>
                            <div class="col-sm-4">
                                <?= $form->field($iReagen, 'unit')->textInput(['maxlength' => true]) ?>
                            </div>
                        </div><!-- .row -->
                        <div class="rows">
                            <?= $form->field($iReagen, 'tanggal_kadaluarsa')->widget(\yii\jui\DatePicker::classname(), [
                                'dateFormat' => 'yyyy-MM-dd',
                            ]) ?>
                        </div><!-- .row -->
                        <div class="rows">
                        	<div class="col-sm-6">
        						<?= $form->field($iReagen, 'id_lokasi')->dropDownList(
                					ArrayHelper::map(Lokasi::find()->all(), 'id_lokasi', 'lokasi_penyimpanan'), ['prompt' => 'Pilih Lokasi Penyimpanan']
            					) ?>
        					</div>
                        	<div class="col-sm-6">
                        		<?= $form->field($iReagen, 'id_supplier')->dropDownList(
        							ArrayHelper::map(Supplier::find()->all(), 'id_supplier', 'supplier'),['prompt' => 'Pilih Supplier']
        						) ?>
        					</div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            </div>

            <?php DynamicFormWidget::end(); ?>
        </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
