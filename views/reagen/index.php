<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use app\controllers\ChemStorageController;
use yii\helpers\ArrayHelper;
use app\models\Lokasi;
use app\models\Supplier;
use app\models\Reagen;
use app\models\ChemStorage;
use kartik\export\ExportMenu;
use kartik\mpdf\Pdf;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ReagenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/*$test = new \yii\db\Expression('NOW()');
var_dump($test);die();*/

$this->title = 'Reagen';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reagen-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Masukkan Reagen', ['create'], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Lokasi Penyimpanan', ['//lokasi/index'], ['class' => 'btn btn-default']) ?>
        <?= Html::a('Supplier', ['//supplier/index'], ['class' => 'btn btn-default']) ?>
        <!-- <?= Html::a('<i class="glyphicon glyphicon-hand-up"></i> Privacy Statement', ['report'], [
            'class'=>'btn btn-danger', 
            'target'=>'_blank', 
            'data-toggle'=>'tooltip', 
            'title'=>'Will open the generated PDF file in a new window'
        ]); ?> -->
    </p>

    <?php
        $gridColumns = [
            'id',
            'nama_reagen',
            'jenis_reagen',
            'jumlah',
            'unit',
            'tanggal_kadaluarsa',
            'lokasi.lokasi_penyimpanan',
            'lokasi.rak',
            'supplier.supplier',
            'status',
        ];

        echo ExportMenu::widget([
            'dataProvider' => $dataProvider,
            'columns' => $gridColumns,
            'exportConfig' =>[
                ExportMenu::FORMAT_PDF => FALSE,
                ExportMenu::FORMAT_CSV => FALSE,
                ExportMenu::FORMAT_HTML => FALSE,
                ExportMenu::FORMAT_TEXT => FALSE,
                ExportMenu::FORMAT_EXCEL => FALSE,
                // ExportMenu::FORMAT_EXCEL_X => FALSE,
            ],
        ]);
    ?>

    <div class= "row" style="padding: 15px">
    <div style="border-top: 7px solid rgba(0, 100, 170, 1); overflow-x: auto; white-space: nowrap; background-color: white; padding: 10px 10px 0px 10px">
        <?php Pjax::begin(); ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'rowOptions' => function($reagen)
        {  
            $reagen = ChemStorageController::findReagen($reagen -> id);
            $flagStock = ChemStorageController::checkStock($reagen -> id);
            $flagExpired = ChemStorageController::checkExpired($reagen -> id);
             
            if($flagStock && $flagExpired)
            {
                return ['class' => 'danger'];
            } else if ($flagStock || $flagExpired){
                return ['class' => 'warning'];
            }
            else return ['class' => 'success'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'id',
                'value' => 'id',
            ],
            'nama_reagen',
            [
                'attribute' => 'jenis_reagen',
                'value' => 'jenis_reagen',
                'filter'=> array('padat' => 'Padat', 'cair' => 'Cair'),
            ],
            'jumlah',
            //'jumlah_minimum',
            'unit',
            'tanggal_kadaluarsa',
            [
                'attribute' => 'id_lokasi',
                'value' => 'lokasi.lokasi_penyimpanan',
                'filter' => Html::activeDropDownList($searchModel, 'id_lokasi', ArrayHelper::map(Lokasi::find()->asArray()->all(), 'id', 'lokasi_penyimpanan'), ['class' => 'form-control', 'prompt' => '-- Lokasi --']),
            ],
            [
                'attribute' => 'id_supplier',
                'value' => 'supplier.supplier',
                'filter' => Html::activeDropDownList($searchModel, 'id_supplier', ArrayHelper::map(Supplier::find()->asArray()->all(), 'id', 'supplier'), ['class' => 'form-control', 'prompt' => '-- Supplier --']),
            ],
            [
                'attribute' => 'pemilik',
                'value' => 'chemStorage.pemilik',
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{view} {delete}',
            ],
            [
                'attribute' => 'status',
                'value' => function($reagen)
                {
                    //$reagen = Reagen::find()->where(['id' => $reagen -> id]);
                    $flagStock = ChemStorageController::checkStock($reagen -> id);
                    $flagExpired = ChemStorageController::checkExpired($reagen -> id);
                    

                    if($flagStock && $flagExpired)
                    {
                        $reagen->status = "LOW STOCK AND EXPIRY WARNING";
                        $reagen->save();
                        return $reagen->status;
                    } 
                    else if ($flagStock) 
                    {
                        $reagen->status = "LOW STOCK";
                        $reagen->save();
                        return $reagen->status; 
                    } 
                    else if ($flagExpired)
                    {
                        $reagen->status = "EXPIRY WARNING";
                        $reagen->save();
                        return $reagen->status;
                    } 
                    else 
                    {   
                        $reagen->status = "-";
                        $reagen->save();
                        return $reagen->status; 
                    }
                }
            ],
        ],
    ]); ?>
        <?php Pjax::end(); ?>
    </div>
    </div>
</div>
