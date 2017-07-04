<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $reagen app\reagens\ChemStorage */

//$this->title = 'Reagen yang diambil: ' . $reagen->id;
$this->params['breadcrumbs'][] = ['label' => 'Chem Storages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $reagen->id, 'url' => ['view', 'id' => $reagen->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chem-storage-update">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_takeReagenForm', [
        'reagen' => $reagen,
        'ambil' => $ambil,
    ]) ?>

</div>
