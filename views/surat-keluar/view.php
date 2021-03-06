<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\SuratKeluar */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Surat Keluar', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->nomor_surat;
?>
<div class="surat-keluar-view">

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
<div class="row"  style="padding: 15px">
    <div class="line col-md-10">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                // 'id',
                'nomor_surat',
                'tanggal_surat',
                'pembuat',
                'tujuan_surat',
                'perihal',
                'keterangan',
                'file_surat',
            ],
        ]) ?>
    </div>
</div>    
</div>
