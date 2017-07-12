<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\LabKit;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenggunaanAlatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $test = \app\models\PenggunaanAlat::find()->where(['not', ['id' => NULL]])->andWhere(['kit_id' => 1])->all();
// var_dump(count($test));die();
// if(count($test) > 1) throw new NotFoundHttpException("Error Processing Request");
// var_dump('<br><h1>'.'PENGGUNAAN ALAT'.'</h1><br>');
// die();

$this->title = 'Penggunaan Alat';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penggunaan-alat-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <!-- <?= Html::a('Pinjam Alat', ['peminjaman'], ['class' => 'btn btn-success']) ?> -->
        <?= Html::a('Alat Laboratorium', ['//lab-kit'], ['class' => 'btn btn-default']) ?>
        <?= Html::button('Pinjam Alat', ['value' => Url::to('/lab-kit/peminjaman'), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
    </p>

    <?php 
        Modal::begin([
            'header' => '<h4>Peminjaman Alat</h4>',
            'id' => 'modal',
            'size' => 'modal-md',
        ]);

        echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

    
    <div class="row" style="padding-left: 15px;padding-right: 15px">
        <div class="col-sm-6" style="padding-left: 0px;padding-right: 10px">
            <div class="col-sm-4" style="background-color: white;padding-left: 0px;padding-right: 0px">
            <?php
                $gridColumns = [
                    'nama_pengguna',
                    'nim',
                    'kit.nama_alat',
                    'tanggal_penggunaan',
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
                <font size=2>Unduh Data Log Peminjaman</font>
            </div>
        </div>
    </div>

    <?php Pjax::begin(); ?>
    <div class= "row" style="padding: 15px">
    <div class="col-md-12" style="border-top: 7px solid rgba(0, 100, 170, 1); overflow-x: auto; white-space: nowrap; background-color: white; padding: 10px 10px 0px 10px">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nama_pengguna',
            'nim',
            [
                'attribute' => 'kit_id',
                'value' => 'kit.nama_alat',
                'filter' => Html::activeDropDownList($searchModel, 'kit_id', ArrayHelper::map(LabKit::find()->asArray()->all(), 'id', 'nama_alat'), ['class' => 'form-control', 'prompt' => '-- Lab Kit --']),
            ],
            'tanggal_penggunaan',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{deleteLog}',
                'buttons' => [
                    'deleteLog' => function($url, $model){
                        $url = Url::to(['lab-kit/delete-log', 'id' => $model->id]);
                        return Html::a('<span class="fa fa-trash"></span>', $url, [
                            'title' => 'delete',
                            'data-confirm' => Yii::t('yii', 'hapus jadwal penggunaan?'),
                            'data-method' => 'post',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
    </div>
    </div>
    <?php Pjax::end(); ?>
</div>
