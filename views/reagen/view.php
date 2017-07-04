<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Lokasi;
use app\controllers\ChemStorageController;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Reagen */

$this->title = $reagen->id;
$id = $reagen -> id;
$this->params['breadcrumbs'][] = ['label' => 'Reagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

// var_dump(date('Y'));die();
?>
<div class="reagen-view">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <p>

        <?= Html::button('Ambil Reagen', ['value' => Url::to('/chem-storage/take-reagen?id='.($id)), 'class' => 'btn btn-success', 'id' => 'modalButton']) ?>
        <?= Html::a('Update', ['update', 'id' => $reagen->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $reagen->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <!-- <?= Html::a('<i class="glyphicon glyphicon-hand-up"></i> Privacy Statement', ['report', 'id' => $reagen -> id], [
            'class'=>'btn btn-danger', 
            'target'=>'_blank', 
            'data-toggle'=>'tooltip', 
            'title'=>'Will open the generated PDF file in a new window'
        ]); ?> -->
    </p>

    <?php 
        Modal::begin([
            'header' => '<h4>Ambil Reagen</h4>',
            'id' => 'modal',
            'size' => 'modal-sm',
        ]);

        echo "<div id='modalContent'></div>";
        Modal::end();
     ?>
    
    <div class= "row" style="padding: 15px">
    <div class="col-md-10" style="border-top: 7px solid rgba(0, 100, 170, 1); overflow-x: auto; white-space: nowrap; background-color: white; padding: 20px 20px 0px 20px">
    <?= DetailView::widget([
        'model' => $reagen,
        'attributes' => [
            [
                'attribute' => 'tanggal_masuk',
                'value' => $model -> tanggal_masuk,
            ],
            'id',
            'nama_reagen',
            'jenis_reagen',
            'jumlah',
            'jumlah_minimum',
            'unit',
            'tanggal_kadaluarsa',
            [
                'attribute' => 'lokasi_penyimpanan',
                'value' => $lokasi -> lokasi_penyimpanan,
            ],
            [
                'attribute' => 'supplier',
                'value' => $supplier -> supplier,
            ],
            [
                'attribute' => 'pemilik',
                'value' => $model -> pemilik,
            ],
        ],
    ]) ?>

        </div>
    </div>

</div>
