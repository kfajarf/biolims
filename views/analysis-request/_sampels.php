<?php

use yii\helpers\Html;
use yii\grid\GridView;


/* @var $this yii\web\View */
/* @var $searchModel app\models\SampelSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Sampels';
//$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sampel-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            // 'id',
            // 'lpsb_order_no',
            // 'kategori',
            // 'nama_lengkap',
            // 'institusi_perusahaan',
            // 'alamat',
            // 'telp_fax',
            // 'no_hp',
            // 'email',
            'sampel_id',
            'nama_sampel',
            'kemasan',
            'jumlah',
            'analisis',
            'metode',
            // 'status_pengujian',
            // 'tanggal_diterima',
            // 'tanggal_selesai',
            // 'total_biaya',
            // 'dp',
            // 'sisa',
            // 'keterangan',
            // 'status',
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
