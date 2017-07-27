<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel app\models\SupplierSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = 'Penyuplai';
?>
<div class="supplier-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Daftar Bahan Kimia', ['//chem-storage'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Lokasi Penyimpanan', ['//lokasi/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::button('Tambah Supplier', ['value' => Url::to('/supplier/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton'])?>
    </p>

    <?php 
        Modal::begin([
            'header' => '<h4>Supplier Baru</h4>',
            'id' => 'modal',
            'size' => 'modal-sm',
        ]);

        echo "<div id='modalContent'></div>";
        Modal::end();
     ?>

    <div class= "row" style="padding: 15px">
    <div class="col-md-6" style="border-top: 7px solid rgba(0, 100, 170, 1); overflow-x: auto; white-space: nowrap; background-color: white; padding: 10px 10px 0px 10px">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'supplier',

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{delete}'
            ],
        ],
    ]); ?>
    </div>
    </div>
</div>
