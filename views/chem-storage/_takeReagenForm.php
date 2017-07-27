<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model app\models\Reagen */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="reagen-form">    

	    <?php $form = ActiveForm::begin(); ?>
		<div class="row">
		    <div class="col-md-12">
		    	<?= $form->field($takeReagen, 'nama_pengambil')->textInput() ?>
		    </div>
		</div>
		<div class="row">
		    <div class="col-md-12">
		    	<?= $form->field($reagen, 'id_reagen', [
					'inputOptions' => ['class' => 'form-control ', 'disabled' => true],
				]) ?>
		    </div>
		</div>
		<div class="row">
		    <div class="col-md-12">
		    	<?= $form->field($reagen, 'nama_reagen', [
					'inputOptions' => ['class' => 'form-control ', 'disabled' => true],
				]) ?>
		    </div>
		</div>
		<div class="row">
		    <div class="col-md-12">
		    	<?= $form->field($reagen, 'jumlah', [
					'inputOptions' => ['class' => 'form-control ', 'disabled' => true],
				])->label('Tersedia ('. $reagen->unit .')') ?>
		    </div>
		</div>
		<div class="row">
		    <div class="col-md-12">
		    	<?= $form->field($takeReagen, 'jumlah')->textInput()->label('Jumlah Pengambilan ('. $reagen->unit.')') ?>
		    </div>
		</div>
    <div class="form-group">
        <?= Html::submitButton( 'Ambil Reagen', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

	</div>
</div>
