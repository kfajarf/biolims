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

    <div class="row" style="padding: 15px; padding-top: 0px;">
        <div class="line col-md-12" style="padding-left: 0px;">
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
                // var_dump($test[0]['fakultas']==NULL);die();
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

    <div class="row" style="padding-left: 15px;padding-right: 15px">
        <div class="col-sm-5" style="padding-left: 0px;padding-right: 15px">
            <div class="col-sm-4" style="background-color: white;padding-left: 0px;padding-right: 15px">
            <?php
                $gridColumnsFak = [
                    'nama_fakultas',
                    'jumlah',
                ];

                echo ExportMenu::widget([
                    'dataProvider' => $dpFrekuensiFakultas,
                    'columns' => $gridColumnsFak,
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
            <div class="col-sm-8" style="background-color: white; padding: 7px">
                <font size=2>Unduh Data Frekuensi Fakultas</font>
            </div>
        </div>
        <div class="col-sm-7" style="padding-left: 0px;padding-right: 0px">
            <div class="col-sm-4" style="background-color: white;padding-left: 0px;padding-right: 15px">
            <?php
                $gridColumnsDep = [
                    'nama_fakultas',
                    'nama_departemen',
                    'jumlah',
                ];

                echo ExportMenu::widget([
                    'dataProvider' => $dpFrekuensiDepartemen,
                    'columns' => $gridColumnsDep,
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
            <div class="col-sm-8" style="background-color: white; padding: 7px">
                <font size=2>Unduh Data Frekuensi Departemen</font>
            </div>
        </div>
    </div>

    <?php Pjax::begin(); ?>
    <div class= "row" style="padding: 15px">
    <div class="col-md-5" style="padding-left: 0px; padding-right: 15px;">
        <div class="line">
    <?= GridView::widget([
        'dataProvider' => $dpFrekuensiFakultas,
        'filterModel' => $smFrekuensiFakultas,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama_fakultas',
            'jumlah',
        ],
    ]); ?>
    </div>
    </div>
    <div class="col-md-7" style="padding-left: 0px; padding-right: 0px;">
        <div class="line">
    <?= GridView::widget([
        'dataProvider' => $dpFrekuensiDepartemen,
        'filterModel' => $smFrekuensiDepartemen,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            'nama_fakultas',
            'nama_departemen',
            'jumlah',
        ],
    ]); ?>
    </div>
        </div>
    </div>
    <?php Pjax::end(); ?>
</div>
