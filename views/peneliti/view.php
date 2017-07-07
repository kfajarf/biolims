<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Peneliti */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penelitis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peneliti-view">

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
            'nama_lengkap',
            'tempat_tanggal_lahir',
            'institusi',
            'nrp_nim',
            'no_handphone',
            'email:email',
            'alamat_dan_no_telp_bogor',
            'alamat_dan_no_telp_orang_tua',
            'judul_penelitian',
            'tanggal_masuk_lpsb',
            'uang_masuk_lpsb',
            'deposit_lpsb',
            'keterangan',
            'biaya_hasil_rekapitulasi',
        ],
    ]) ?>

</div>
