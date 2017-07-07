<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use app\models\LabKit;
use yii\bootstrap\Modal;
use yii\helpers\Url;
use yii\widgets\Pjax;
use kartik\export\ExportMenu;
use app\assets\HighchartsAsset;

HighchartsAsset::register($this);

/* @var $this yii\web\View */
/* @var $searchModel app\models\PenggunaanAlatSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

// $test = \app\models\PenggunaanAlat::find()->where(['not', ['id' => NULL]])->andWhere(['kategori' => 1])->all();
// var_dump(count($test));die();
// if(count($test) > 1) throw new NotFoundHttpException("Error Processing Request");
// var_dump('<br><h1>'.'PENGGUNAAN ALAT'.'</h1><br>');
// die();

$this->title = 'Data Report';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
    <div class="row" style="padding-left: 15px; padding-right: 15px">
      <div class="col-md-8 line">
      <div id="container"></div><br>
        <?php 
        $jumlahJasa = [];
        for ($idx=1; $idx <= 12; $idx++) {
          $eachMonth = \Yii::$app->db->createCommand("Select count(id) as jumlah from analysis_request where month(tanggal_diterima) = $idx")->queryOne();
          $jumlahJasa[$idx] = $eachMonth['jumlah'];
        };
        $this->registerJs("
            Highcharts.chart('container', {
                chart: {
                    type: 'column'
                },
                title: {
                    text: 'Jasa Layanan Analisis'
                },
                xAxis: {
                    categories: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec']
                },
                yAxis: {
                    min: 0,
                    title: {
                        text: 'Jumlah Jasa Layanan'
                    }
                },
                legend: {
                    shadow: false
                },
                tooltip: {
                    shared: true
                },
                plotOptions: {
                    column: {
                        grouping: false,
                        shadow: false,
                        borderWidth: 0
                    }
                },
                series: [{
                    name: 'Sasaran Mutu',
                    color: 'rgba(165,170,217,.3)',
                    data: [35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35, 35],
                    pointPadding: 0,
                    pointPlacement: 0
                }, {
                    name: 'Jumlah Jasa Layanan',
                    color: 'rgba(126,86,134,1)',
                    data: [$jumlahJasa[1], $jumlahJasa[2], $jumlahJasa[3], $jumlahJasa[4], $jumlahJasa[5], $jumlahJasa[6], $jumlahJasa[7], $jumlahJasa[8], $jumlahJasa[9], $jumlahJasa[10], $jumlahJasa[11], $jumlahJasa[12]],
                    pointPadding: 0,
                    pointPlacement: 0
                }]
            });
        ")?>
        </div>
    </div>
    <br>
    <?php
        $gridColumns = [
            'lpsb_order_no',
            'kategori',
            'nama_sampel',
            'jenis',
            'kemasan',
            'jumlah',
            'jenis_metode_analisis',
            'status_pengujian',
            'tanggal_diterima',
            'tanggal_selesai',
            'total_biaya',
            'dp',
            'sisa',
            'keterangan',
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

    <?php Pjax::begin(); ?>
    <div class= "row" style="padding: 15px">
    <div class="col-md-12" style="border-top: 7px solid rgba(0, 100, 170, 1); overflow-x: auto; white-space: nowrap; background-color: white; padding: 10px 10px 0px 10px">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            // 'id',
            'lpsb_order_no',
            'nama_sampel',
            [
                'attribute' => 'jenis',
                'value' => 'jenis',
                'filter' => Html::activeDropDownList($searchModel, 'jenis', ArrayHelper::map(\app\models\JenisAnalisis::find()->all(), 'jenis', 'jenis'), ['class' => 'form-control', 'prompt' => '-- Jenis --']),
            ],
            'kemasan',
            'jumlah',
            'jenis_metode_analisis',
            'status_pengujian',
            'tanggal_diterima',
            'tanggal_selesai',
            'total_biaya',
            'dp',
            'sisa',
            'keterangan',
            [
                'attribute' => 'kategori',
                'value' => 'kategori',
                'filter' => Html::activeDropDownList($searchModel, 'kategori', ArrayHelper::map(\app\models\KategoriKlien::find()->all(), 'kategori', 'kategori'), ['class' => 'form-control', 'prompt' => '-- Kategori --']),
            ],
        ],
    ]); ?>
    </div>
    </div>
    <?php Pjax::end(); ?>
</div>
