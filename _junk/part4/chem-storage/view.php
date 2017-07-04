<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\ChemStorage */

$this->title = $model->id_storage;
$this->params['breadcrumbs'][] = ['label' => 'Chem Storages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chem-storage-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_storage], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_storage], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id_storage',
            'pemilik',
            'tanggal_masuk',
        ],
    ]) ?>

</div>
