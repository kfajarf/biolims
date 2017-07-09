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

    <div class="row" >
      <div class="col-md-7">
      <div class="line" style="padding-left: 0px">
      <div id="jasa_layanan_barChart"></div>
        <?php 
        $jumlahJasa = [];
        for ($idx=1; $idx <= 12; $idx++) {
          $eachMonth = \Yii::$app->db->createCommand("Select count(id) as jumlah from analysis_request where month(tanggal_diterima) = $idx")->queryOne();
          $jumlahJasa[$idx] = $eachMonth['jumlah'];
        };
        $this->registerJs("
            Highcharts.chart('jasa_layanan_barChart', {
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
                credits: {
                    enabled: false
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
    <div class="col-md-5" style="padding-left: 0px">
    <div class="line" >
    <div id="kategori-klien"></div>
        <?php 
            $data = [];
            $total = 0;
            
            $data1 = \Yii::$app->db->createCommand("select kategori, count(*) as jumlah from ((select lpsb_order_no, kategori from total_data_jasa_layanan group by lpsb_order_no) as test) where kategori = 'Internal'")->queryOne();
            $data2 = \Yii::$app->db->createCommand("select kategori, count(*) as jumlah from ((select lpsb_order_no, kategori from total_data_jasa_layanan group by lpsb_order_no) as test) where kategori = 'Mahasiswa'")->queryOne();
            $data3 = \Yii::$app->db->createCommand("select kategori, count(*) as jumlah from ((select lpsb_order_no, kategori from total_data_jasa_layanan group by lpsb_order_no) as test) where kategori = 'Instansi Pemerintah'")->queryOne();
            $data4 = \Yii::$app->db->createCommand("select kategori, count(*) as jumlah from ((select lpsb_order_no, kategori from total_data_jasa_layanan group by lpsb_order_no) as test) where kategori = 'Perusahaan'")->queryOne();
            $data5 = \Yii::$app->db->createCommand("select kategori, count(*) as jumlah from ((select lpsb_order_no, kategori from total_data_jasa_layanan group by lpsb_order_no) as test) where kategori = 'Individu'")->queryOne();  
            $data[1] = $data1['jumlah'];
            $data[2] = $data2['jumlah'];
            $data[3] = $data3['jumlah'];
            $data[4] = $data4['jumlah'];
            $data[5] = $data5['jumlah'];
            $total = $data[1] + $data[2] + $data[3] + $data[4] + $data[5];
            

            for ($dataPercentage=[], $idx=1; $idx <= 5; $idx++) { 
                $dataPercentage[$idx] = ($data[$idx] / $total)*100;
            }
            // die();
        $this->registerJs("
            $(document).ready(function () {
                // Build the chart
                Highcharts.chart('kategori-klien', {
                    chart: {
                        plotBackgroundColor: null,
                        plotBorderWidth: null,
                        plotShadow: false,
                        type: 'pie'
                    },
                    title: {
                        text: 'Proporsi Kategori Pengguna Jasa Layanan'
                    },
                    tooltip: {
                        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                    },
                    plotOptions: {
                        pie: {
                            allowPointSelect: true,
                            cursor: 'pointer',
                            dataLabels: {
                                enabled: false
                            },
                            showInLegend: true
                        }
                    },
                    credits: {
                        enabled: false
                    },
                    series: [{
                        name: 'Proporsi',
                        colorByPoint: true,
                        data: [{
                            name: 'Individu',
                            y: $dataPercentage[5]
                        }, {
                            name: 'Perusahaan',
                            y: $dataPercentage[4]
                        }, {
                            name: 'Instansi Pemerintah',
                            y: $dataPercentage[3]
                        }, {
                            name: 'Internal',
                            y: $dataPercentage[1],
                        }, {
                            name: 'Mahasiswa',
                            y: $dataPercentage[2],
                            sliced: true,
                            selected: true
                        }]
                    }]
                });
            });
        ")?>
        </div>
        </div>
    </div>
    <br>
    <div class="row" style="padding: 15px">
    <div class="line col-md-7">
    <div id="jenis-analisis" style="min-width: 310px; height: 350px; max-width: 600px; margin: 0 auto"></div>
        <script type="text/javascript">
            var analisis = [], test=[1];
        <?php 
            $analisis = [];
            $jumlah = [];
            $asd = 'LLOL';
            $test = \Yii::$app->db->createCommand("select analisis, jumlah from frekuensi_pilihan_jenis_analisis")->queryAll();
            foreach ($test as $idx => $testItem) { 
                ?>
                analisis.push({
                    name: '<?= ($testItem['analisis'] ? $testItem['analisis'] : "undefined") ?>',
                    y: <?= $testItem['jumlah'] ?>,
                });
            <?php }
        ?>
        // document.write(analisis);
        </script> 
        <?php 
            // var_dump($test[0]['analisis']==NULL);die();
            // var_dump($analisis);
            // die();
        $this->registerJs("
            Highcharts.chart('jenis-analisis', {
                chart: {
                    plotBackgroundColor: null,
                    plotBorderWidth: null,
                    plotShadow: false,
                    type: 'pie'
                },
                title: {
                    text: 'Browser market shares January, 2015 to May, 2015'
                },
                tooltip: {
                    pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
                },
                plotOptions: {
                    pie: {
                        allowPointSelect: true,
                        cursor: 'pointer',
                        dataLabels: {
                            enabled: true,
                            format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                            style: {
                                color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                            }
                        }
                    }
                },
                credits:{
                    enabled:false
                },
                series: [{
                    name: 'Proporsi',
                    colorByPoint: true,
                    data: analisis,
                }]
            });
        ")?>

        </div>
        </div>
    <?php
        $gridColumns = [
            // 'id',
            'lpsb_order_no',
            'kategori',
            'nama_lengkap',
            'institusi_perusahaan',
            'alamat',
            'telp_fax',
            'no_hp',
            'email',
            'analisis',
            'sampel_id',
            'nama_sampel',
            'kemasan',
            'jumlah',
            'metode',
            'status_pengujian',
            'tanggal_diterima',
            'tanggal_selesai',
            'total_biaya',
            'dp',
            'sisa',
            'keterangan',
            'status',
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
                'attribute' => 'analisis',
                'value' => 'analisis',
                'filter' => Html::activeDropDownList($searchModel, 'analisis', ArrayHelper::map(\app\models\JenisAnalisis::find()->all(), 'jenis', 'jenis'), ['class' => 'form-control', 'prompt' => '-- Jenis --']),
            ],
            'kemasan',
            'jumlah',
            'metode',
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
