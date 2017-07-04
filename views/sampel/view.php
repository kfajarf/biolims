<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Sampel */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sampels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sampel-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
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
            'id',
            'jenis',
            'kemasan',
            'jumlah',
            'jenis_metode_analisis',
            'lpsb_order_no',
            'id_pemohon',
        ],
    ]) ?>

</div>
