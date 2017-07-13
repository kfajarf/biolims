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

// $analisis = \app\models\PenggunaanAlat::find()->where(['not', ['id' => NULL]])->andWhere(['kategori' => 1])->all();
// var_dump(count($analisis));die();
// if(count($test) > 1) throw new NotFoundHttpException("Error Processing Request");
// var_dump('<br><h1>'.'PENGGUNAAN ALAT'.'</h1><br>');
// die();

$this->title = 'Data Report';
$this->params['breadcrumbs'][] = $this->title;
// var_dump(Yii::$app->controller->id);die();
?>
<div class="index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="row" >
      <div class="col-md-7" >
      <div class="line" style="padding-left: 0px">
      <div id="jasa_layanan_barChart"></div>
        <?php 
        // $test = ['jumlah' => 0];
          $January = (\Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'January'")->queryOne() ? \Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'January'")->queryOne() : ['jumlah' => 0]);
          $February = (\Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'February'")->queryOne() ? \Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'February'")->queryOne() : ['jumlah' => 0]);
          $March = (\Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'March'")->queryOne() ? \Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'March'")->queryOne() : ['jumlah' => 0]);
          $April = (\Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'April'")->queryOne() ? \Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'April'")->queryOne() : ['jumlah' => 0]);
          $May = (\Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'May'")->queryOne() ? \Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'May'")->queryOne() : ['jumlah' => 0]);
          $June = (\Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'June'")->queryOne() ? \Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'June'")->queryOne() : ['jumlah' => 0]);
          $July = (\Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'July'")->queryOne() ? \Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'July'")->queryOne() : ['jumlah' => 0]);
          $August = (\Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'August'")->queryOne() ? \Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'August'")->queryOne() : ['jumlah' => 0]);
          $September = (\Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'September'")->queryOne() ? \Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'September'")->queryOne() : ['jumlah' => 0]);
          $October = (\Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'October'")->queryOne() ? \Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'October'")->queryOne() : ['jumlah' => 0]);
          $November = (\Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'November'")->queryOne() ? \Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'November'")->queryOne() : ['jumlah' => 0]);
          $December = (\Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'December'")->queryOne() ? \Yii::$app->db->createCommand("select jumlah from frekuensi_jasa_layanan_per_bulan where bulan like 'December'")->queryOne() : ['jumlah' => 0]);
          // var_dump($test);die();
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
                    pointPadding: 0.15,
                    pointPlacement: -.2
                }, {
                    name: 'Jumlah Jasa Layanan',
                    color: 'rgba(126,86,134,1)',
                    data: [$January[jumlah], $February[jumlah], $March[jumlah], $April[jumlah], $May[jumlah], $June[jumlah], $July[jumlah], $August[jumlah], $September[jumlah], $October[jumlah], $November[jumlah], $December[jumlah]],
                    pointPadding: 0.15,
                    pointPlacement: .2
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
            $frekuensiKlien = \app\models\FrekuensiKlienJasaLayanan::find()->asArray()->all();
            $kategori=[];
            $i=1;
            // var_dump($frekuensiKlien[0]['kategori']==NULL);die();
            foreach ($frekuensiKlien as $klien) {
                // var_dump(!($klien['kategori']==NULL));die();
                if(!($klien['kategori']==NULL)){
                    $kategori[$i]=$klien;
                    $total += $kategori[$i]['jumlah'];
                    $i++;
                    // var_dump($klien['kategori']);
                }
            }
            // die();
            // var_dump($kategori);die();
            $data1 = \Yii::$app->db->createCommand("select kategori, count(*) as jumlah from ((select lpsb_order_no, kategori from total_data_jasa_layanan group by lpsb_order_no) as test) where kategori = 'Internal'")->queryOne();
            $data2 = \Yii::$app->db->createCommand("select kategori, count(*) as jumlah from ((select lpsb_order_no, kategori from total_data_jasa_layanan group by lpsb_order_no) as test) where kategori = 'Mahasiswa'")->queryOne();
            $data3 = \Yii::$app->db->createCommand("select kategori, count(*) as jumlah from ((select lpsb_order_no, kategori from total_data_jasa_layanan group by lpsb_order_no) as test) where kategori = 'Instansi Pemerintah'")->queryOne();
            $data4 = \Yii::$app->db->createCommand("select kategori, count(*) as jumlah from ((select lpsb_order_no, kategori from total_data_jasa_layanan group by lpsb_order_no) as test) where kategori = 'Perusahaan'")->queryOne();
            $data5 = \Yii::$app->db->createCommand("select kategori, count(*) as jumlah from ((select lpsb_order_no, kategori from total_data_jasa_layanan group by lpsb_order_no) as test) where kategori = 'Individu'")->queryOne();  
            $data[1] = $kategori[1]['jumlah'];
            $data[2] = $kategori[2]['jumlah'];
            $data[3] = $kategori[3]['jumlah'];
            $data[4] = $kategori[4]['jumlah'];
            $data[5] = $kategori[5]['jumlah'];
            // $total = $data[1] + $data[2] + $data[3] + $data[4] + $data[5];
            
            // var_dump($total);die();
            for ($dataPercentage=[], $idx=1; $idx <= 5; $idx++) { 
                $dataPercentage[$idx] = ($kategori[$idx]['jumlah'] / $total)*100;
            }
            // die();
        $this->registerJs("
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
                                enabled: true,
                                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                                style: {
                                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                                }
                            }
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
                            y: $dataPercentage[1]
                        }, {
                            name: 'Perusahaan',
                            y: $dataPercentage[2]
                        }, {
                            name: 'Instansi Pemerintah',
                            y: $dataPercentage[3]
                        }, {
                            name: 'Mahasiswa',
                            y: $dataPercentage[4],
                            sliced: true,
                            selected: true
                        }, {
                            name: 'Internal',
                            y: $dataPercentage[5],
                        }]
                    }]
                });
        ")?>
        </div>
        </div>
    </div>
    <br>
    <div class="row" style="padding: 15px">
        <div class="col-md-7" style="padding-left: 0px">
            <div class="line">
            <div id="jenis-analisis" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
            <script type="text/javascript">
                var analisis = [], test=[1];
            <?php 
                $analisis = [];
                $jumlah = [];
                $asd = 'LLOL';
                $analisis = \app\models\FrekuensiPilihanJenisAnalisis::find()->asArray()->all();
                foreach ($analisis as $idx => $analisisItem) { 
                    ?>
                    analisis.push({
                        name: '<?= ($analisisItem['analisis'] ? $analisisItem['analisis'] : "undefined") ?>',
                        y: <?= $analisisItem['jumlah'] ?>,
                    });
                <?php }
            ?>
            // document.write(analisis);
            </script> 
            <?php 
            // var_dump($analisis);die();
                // var_dump($analisis[0]['analisis']==NULL);die();
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
                        text: 'Proporsi Pilihan Jenis Analisis'
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
        <div class="col-md-5" style="padding-left: 0px; padding-right: 0px">
            <div class="line" style="padding-left: 0px">
                <div id="fakultas-chart" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>
            <script type="text/javascript">
                var fakultas = [];
                var fakultasSeries = [];
            <?php 
                $jumlah=0;
                $fakultas = \Yii::$app->db->createCommand("SELECT akronim, nama_fakultas as fakultas, count(*) as jumlah FROM `info_departemen_peneliti` group by akronim")->queryAll();
                $departemen = \Yii::$app->db->createCommand("SELECT akronim, nama_fakultas as fakultas, nama_departemen as departemen, count(*) as jumlah FROM `info_departemen_peneliti` group by nama_departemen")->queryAll();
                foreach ($departemen as $i => $departemenItem) {
                    $jumlah += $departemenItem['jumlah'];
                }
                foreach ($fakultas as $idx => $fakultasItem) { 
                    ?>
                    fakultas.push({
                        name: '<?= $fakultasItem['akronim'] ?>',
                        y: <?= ($fakultasItem['jumlah']/$jumlah)*100 ?>,
                        drilldown: '<?= $fakultasItem['fakultas'] ?>',
                    });
                    var departemen = [];
                    <?php foreach($departemen as $idx => $departemenItem){
                        if($departemenItem['fakultas'] == $fakultasItem['fakultas']){ ?>
                            departemen.push(['<?= $departemenItem['departemen'] ?>', <?= ($departemenItem['jumlah']/$fakultasItem['jumlah'])*100 ?>]);
                        <?php };
                    }; ?>
                    fakultasSeries.push({
                        name: '<?= $fakultasItem['fakultas'] ?>',
                        id: '<?= $fakultasItem['fakultas'] ?>',
                        // for(i=0; i<5; i++) departemen.push({'<?= $fakultasItem['fakultas'] ?>', <?= $fakultasItem['jumlah'] ?>});
                        data: departemen, 
                    });

                <?php }
            // console.log()
            ?>
            // document.write(fakultas);
            </script> 
            <?php 
                // var_dump($jumlah);die();
                // var_dump($analisis[0]['fakultas']==NULL);die();
                // var_dump($departemen);
                // die();
            $this->registerJs("
                Highcharts.chart('fakultas-chart', {
                    chart: {
                    type: 'pie'
                },
                title: {
                    text: 'Proporsi Program Studi Mahasiswa'
                },
                subtitle: {
                    text: 'Klik gambar untuk melihat proporsi mahasiswa per fakultas'
                },
                plotOptions: {
                    series: {
                        dataLabels: {
                            enabled: true,
                            format: '{point.name}: {point.y:.1f}%'
                        }
                    }
                },
                credits: {
                    enabled: false,
                },
                tooltip: {
                    headerFormat: '<span style=\'font-size:11px\'>{series.name}</span><br>',
                    pointFormat: '<span style=\'color:{point.color}\'>{point.name}</span>: <b>{point.y:.2f}%</b> of total<br/>'
                },
                series: [{
                    name: 'Fakultas',
                    colorByPoint: true,
                    data: fakultas,
                }],
                drilldown: {
                    series: fakultasSeries,
                }
            });
            ")?>
            </div>
        </div>
    </div>
</div>
