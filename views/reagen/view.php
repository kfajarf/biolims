<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\Lokasi;
use app\models\TakeReagen;
use app\controllers\ChemStorageController;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use yii\grid\GridView;
use kartik\export\ExportMenu;

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
    
     <?php if (Yii::$app->session->hasFlash('bahanKurang')): ?>

        <div class="alert alert-danger col-md-10">
            Jumlah yang diambil melebihi jumlah bahan yang tersedia. Silahkan ambil sesuai dengan jumlah yang tersedia. 
        </div>

    <?php endif; ?>

    <div class= "row" style="padding: 15px">
    <div class="col-md-10" style="border-top: 7px solid rgba(0, 100, 170, 1); overflow-x: auto; white-space: nowrap; background-color: white; padding: 20px 20px 0px 20px">
    <?= DetailView::widget([
        'model' => $reagen,
        'attributes' => [
            [
                'attribute' => 'tanggal_masuk',
                'value' => $model -> tanggal_masuk,
            ],
            'id_reagen',
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
<?php $log = TakeReagen::findAll(['id_reagen' => $reagen->id, 'chem_storage_id' => $reagen->id_storage]);
    if($log != NULL): ?>
    <div class="row" style="padding-left: 15px;padding-right: 15px">
        <div class="col-sm-10" style="padding-left: 0px;padding-right: 0px">
            <div class="col-sm-4" style="background-color: white;padding-left: 0px;padding-right: 0px">
            <?php
                $gridColumns = [
                    'id_reagen',
                    'nama_reagen',
                    'jumlah',
                    'unit',
                    'tanggal_pengambilan',
                ];

                echo ExportMenu::widget([
                    'dataProvider' => $dataProvider,
                    'columns' => $gridColumns,
                    'exportConfig' => [
                        ExportMenu::FORMAT_TEXT => FALSE,
                        ExportMenu::FORMAT_PDF => FALSE,
                        ExportMenu::FORMAT_EXCEL => FALSE,
                        ExportMenu::FORMAT_CSV => FALSE,
                        ExportMenu::FORMAT_HTML => FALSE,
                    ],
                ]);
            ?>
            </div>
            <div class="col-sm-8" style="background-color: white; padding-top: 7px; padding-bottom: 7px">
                <font size=2>Unduh Data Log Pengambilan Bahan</font>
            </div>
        </div>
    </div>

    <?php Pjax::begin(); ?>
    <div class= "row" style="padding: 15px">
        <div class="col-md-10" style="padding-left: 0px;padding-right: 0px">
            <div class="line">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                [
                    'attribute' => 'id_reagen',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ]
                ],
                [
                    'attribute' => 'nama_reagen',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ]
                ],
                [
                    'attribute' =>'jumlah',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ],
                ],
                [
                    'attribute' =>'unit',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ],
                ],
                [
                    'attribute' => 'tanggal_pengambilan',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ]
                ],
            ],
        ]); ?>
            </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
<?php endif; ?>
</div>
