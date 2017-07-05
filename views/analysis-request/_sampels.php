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

            'nama_sampel',
            'jenis',
            'kemasan',
            'jumlah',
            'jenis_metode_analisis',
            //'lpsb_order_no',
            // 'id_pemohon',
            // ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
