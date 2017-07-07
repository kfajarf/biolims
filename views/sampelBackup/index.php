<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Analysis Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="supplier-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'nama_sampel',
            'jenis',
            'kemasan',
            'jumlah',
            'jenis_metode_analisis',
            'lpsb_order_no',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    
</div>
