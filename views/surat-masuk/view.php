<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SuratMasuk */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Surat Masuks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-masuk-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

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
<div class="row" style="padding: 15px">
    <div class="line">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            // 'id',
            'nomor_surat',
            'tanggal_surat',
            'tanggal_terima',
            'sumber_surat',
            'perihal',
            'keterangan',
            'file_surat',
        ],
    ]) ?>
    </div>
</div>
</div>
