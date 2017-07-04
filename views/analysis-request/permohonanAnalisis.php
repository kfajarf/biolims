<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChemStorage */

//$this->title = 'model yang diambil: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Chem Storages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chem-storage-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_permohonanAnalisis', [
        'model' => $model,
        'sampel' => $sampel,
        'pemohon' => $pemohon,
    ]) ?>

</div>
