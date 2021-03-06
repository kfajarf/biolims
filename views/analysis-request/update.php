<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysisRequest */

$this->title = 'LPSB Order No: ' . $model->lpsb_order_no;
$this->params['breadcrumbs'][] = ['label' => 'Surat Analisis Sampel', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="analysis-request-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
		'modelsKAnalisis' => $modelsKAnalisis,
		'modelsSampel' => $modelsSampel,
		'pemohon' => $pemohon,
    ]) ?>

</div>
