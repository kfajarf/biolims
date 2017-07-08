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
    
    <div class="row" style="padding-left: 15px; padding-right: 15px">
      <div class="col-md-7 line" style="padding-right: 0px">
      <div id="analisis-sampel-linechart"></div><br>
        <?php 
        $biasa = [];
        $percepatan = [];
        for ($idx=1; $idx <= 12; $idx++) {
          $eachMonthBiasa = \Yii::$app->db->createCommand("Select count(id) as jumlah from analysis_request where month(tanggal_diterima) = $idx and status_pengujian = 'biasa'")->queryOne();
          $eachMonthPercepatan = \Yii::$app->db->createCommand("Select count(id) as jumlah from analysis_request where month(tanggal_diterima) = $idx and status_pengujian = 'percepatan'")->queryOne();  
          $biasa[$idx] = $eachMonthBiasa['jumlah'];
          $percepatan[$idx] = $eachMonthPercepatan['jumlah'];
        };
        $this->registerJs("
            Highcharts.chart('analisis-sampel-linechart', {

            title: {
                text: 'Analisis Sampel'
            },

            subtitle: {
                text: 'Perbandingan Status Pengujian Permohonan Analisis'
            },

            yAxis: {
                title: {
                    text: 'Jumlah Permintaan'
                }
            },

            xAxis: {
                categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
            },

            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle'
            },

            credits: {
                enabled: false
            },

            series: [{
                name: 'Biasa',
                data: [$biasa[1], $biasa[2], $biasa[3], $biasa[4], $biasa[5], $biasa[6], $biasa[7], $biasa[8], $biasa[9], $biasa[10], $biasa[11], $biasa[12]]
            }, {
                name: 'Percepatan',
                data: [$percepatan[1], $percepatan[2], $percepatan[3], $percepatan[4], $percepatan[5], $percepatan[6], $percepatan[7], $percepatan[8], $percepatan[9], $percepatan[10], $percepatan[11], $percepatan[12]]
            }]

        });
        ")?>
        </div>
      <div class="col-md-5 line">
      <div id="kajiulang-barchart"></div><br>
        <?php 
        $metode = [];
        $peralatan = [];
        $personel = [];
        $bahanKimia = [];
        $akomodasi = [];
        for ($idx=0; $idx <= 1; $idx++) {
          $metodeData = \Yii::$app->db->createCommand("Select count(*) as jumlah from kaji_ulang where metode = $idx")->queryOne();
          $peralatanData = \Yii::$app->db->createCommand("Select count(*) as jumlah from kaji_ulang where peralatan = $idx")->queryOne();
          $personelData = \Yii::$app->db->createCommand("Select count(*) as jumlah from kaji_ulang where personel = $idx")->queryOne();
          $bahanKimiaData = \Yii::$app->db->createCommand("Select count(*) as jumlah from kaji_ulang where bahan_kimia = $idx")->queryOne();
          $akomodasiData = \Yii::$app->db->createCommand("Select count(*) as jumlah from kaji_ulang where kondisi_akomodasi = $idx")->queryOne();
          $metode[$idx] = $metodeData['jumlah'];
          $peralatan[$idx] = $peralatanData['jumlah'];
          $personel[$idx] = $personelData['jumlah'];
          $bahanKimia[$idx] = $bahanKimiaData['jumlah'];
          $akomodasi[$idx] = $akomodasiData['jumlah'];
        };
        $this->registerJs("
            Highcharts.chart('kajiulang-barchart', {
                chart: {
                type: 'bar'
            },
            title: {
                text: 'Kompetensi Sumber Daya Laboratorium'
            },
            subtitle: {
                text: 'Kaji Ulang Permintaan, Tender, dan Kontrak'
            },
            xAxis: {
                categories: ['Metode', 'Peralatan', 'Personel', 'Bahan Kimia', 'Akomodasi'],
                title: {
                    text: 'Parameter Pengujian'
                }
            },
            yAxis: {
                min: 0,
                title: {
                    text: null
                },
                labels: {
                    overflow: 'justify'
                }
            },
            tooltip: {
            },
            plotOptions: {
                bar: {
                    dataLabels: {
                        enabled: true
                    }
                }
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'top',
                x: -40,
                y: 80,
                floating: true,
                borderWidth: 1,
                backgroundColor: ((Highcharts.theme && Highcharts.theme.legendBackgroundColor) || '#FFFFFF'),
                shadow: true
            },
            credits: {
                enabled: false
            },
            series: [{
                name: 'Internal',
                data: [
                  $metode[1],
                  $peralatan[1],
                  $personel[1],
                  $bahanKimia[1],
                  $akomodasi[1],
                ]
            }, {
                name: 'Eksternal',
                data: [
                  $metode[0],
                  $peralatan[0],
                  $personel[0],
                  $bahanKimia[0],
                  $akomodasi[0],
                ]
            }]
        });
        ")?>
        </div>
    </div>
    <br>

    
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
            'lpsb_order_no',
            [
                'attribute' => 'nama_lengkap',
                'value' => 'pemohonAnalisis.nama_lengkap',
            ],
            [
                'attribute' => 'institusi_perusahaan',
                'value' => 'pemohonAnalisis.institusi_perusahaan',
            ],
            // 'pemohon.alamat:ntext',
            // 'pemohon.telp_fax',
            // 'pemohon.no_hp',
            [
                'attribute' => 'email',
                'value' => 'pemohonAnalisis.email',
            ],
            [
                'attribute' => 'status_pengujian',
                'value' => 'status_pengujian',
                'filter' => array('biasa' => 'Biasa', 'percepatan' => 'Percepatan')
            ],
            //'tanggal_diterima',
            'tanggal_selesai',
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


