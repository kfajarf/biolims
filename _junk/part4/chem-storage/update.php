<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\ChemStorage */

$this->title = 'Update Chem Storage: ' . $model->id_storage;
$this->params['breadcrumbs'][] = ['label' => 'Chem Storages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_storage, 'url' => ['view', 'id' => $model->id_storage]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="chem-storage-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
