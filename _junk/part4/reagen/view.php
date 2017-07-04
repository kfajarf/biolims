<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Reagen */

$this->title = $model->id_bahan;
$this->params['breadcrumbs'][] = ['label' => 'Reagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reagen-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id_bahan], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id_bahan], [
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
            'id_bahan',
            'nama_bahan',
            'jenis_bahan',
            'jumlah',
            'jumlah_minimum',
            'unit',
            'tanggal_kadaluarsa',
            'id_lokasi',
            'id_supplier',
            'status',
            'id_storage',
        ],
    ]) ?>

</div>
