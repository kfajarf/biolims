<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysisRequest */

$this->title = $model->lpsb_order_no;
$this->params['breadcrumbs'][] = ['label' => 'Analysis Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analysis-request-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model -> lpsb_order_no], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model -> lpsb_order_no], [
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
            'lpsb_order_no',
            'pemohon.nama',
            'pemohon.institusi',
            'pemohon.alamat',
            'pemohon.telp_fax',
            'pemohon.no_hp',
            'pemohon.email',
            'sampel.id_sampel',
            'sampel.nama_sampel',
            'sampel.jenis_sampel',
            'sampel.kemasan',
            'sampel.jumlah',
            'sampel.jenis_metode_analisis',
            'pengujian.status_pengujian',
            'pengujian.tanggal_selesai',
            'total_biaya',
            'dp',
            'sisa',
        ],
    ]) ?>

</div>
