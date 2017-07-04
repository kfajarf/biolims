<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReagenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reagens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reagen-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_reagen',
            'nama_reagen',
            'jenis_reagen',
            'jumlah',
            //'jumlah_minimum',
            'unit',
            'tanggal_kadaluarsa',
            'status',
            'lokasi.lokasi_penyimpanan',
            'supplier.supplier',
        ],
    ]); ?>
</div>
