<?php

use yii\helpers\Html;
use app\models\DataJasaLayananSearch;
use kartik\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\AnalysisRequest;
use app\assets\HighchartsAsset;

HighchartsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnalysisRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = "Analysis Requests";
$this->params['breadcrumbs'][] = $this->title;

//var_dump(Yii::$app->controller->action->id);die();
$percepatan=[];
$biasa=[];
for ($idx=1; $idx <= 12; $idx++) 
{ 
    $eachMonthPercepatan = \Yii::$app->db->createCommand("Select count(id) as jumlah from analysis_request where month(tanggal_diterima) = $idx and status_pengujian = 'percepatan'")->queryOne();
    $eachMonthBiasa = \Yii::$app->db->createCommand("Select count(id) as jumlah from analysis_request where month(tanggal_diterima) = $idx and status_pengujian = 'biasa'")->queryOne();
    $percepatan[$idx] = $eachMonthPercepatan['jumlah'];
    $biasa[$idx] = $eachMonthBiasa['jumlah'];
} 
// var_dump($percepatan[5]);die();
?>
<div class="analysis-request-index">

    <!--<h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>-->

    <p>
        <?= Html::a('Surat Permohonan Analisis', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
        
    <div class= "row" style="padding: 15px">
    <div style="border-top: 7px solid rgba(0, 100, 170, 1); overflow-x: hidden; white-space: nowrap; background-color: white; padding: 10px 10px 0px 10px">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model, $key, $index, $column)
                {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function($model, $key, $index, $column)
                {
                    $searchModel = new DataJasaLayananSearch();
                    $searchModel -> id = $model -> id;
                    $dataProvider = $searchModel -> search(Yii::$app-> request-> queryParams);

                    return Yii::$app-> controller-> renderPartial('_sampels', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                },
            ],
            [
                'attribute' => 'lpsb_order_no',
                'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Pencarian'
                ]
            ],
            [
                'attribute' => 'nama_lengkap',
                'value' => 'pemohonAnalisis.nama_lengkap',
                'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Pencarian'
                ]
            ],
            [
                'attribute' => 'institusi_perusahaan',
                'value' => 'pemohonAnalisis.institusi_perusahaan',
                'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Pencarian'
                ]
            ],
            // 'pemohon.alamat:ntext',
            // 'pemohon.telp_fax',
            // 'pemohon.no_hp',
            [
                'attribute' => 'email',
                'value' => 'pemohonAnalisis.email',
                'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Pencarian'
                ]
            ],
            [
                'attribute' => 'status_pengujian',
                'value' => 'status_pengujian',
                'filterInputOptions' => [
                'class'       => 'form-control',
                'placeholder' => 'Pencarian',
                ],
                'filter' => array('biasa' => 'Biasa', 'percepatan' => 'Percepatan'),
            ],
            //'tanggal_diterima',
            [
                'attribute' => 'tanggal_selesai',
                'value' => function($model)
                {
                    return date('d-m-Y', strtotime($model->tanggal_selesai));
                }
            ],
            'total_biaya',
            //'dp',
            //'sisa',
            //'keterangan:ntext',
            [
                'attribute'=>'status',
                'format'=>'raw',
                'value' => function($model)
                {
                    if($model->status == 'belum lunas') return Html::a('Lunas',['lunas', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    else return 'LUNAS';
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    </div>
</div>


