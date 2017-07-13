<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\SuratKeluarSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surat Keluar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="surat-keluar-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Tambah Surat Keluar', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

<div class="row" style="padding: 15px">
    <div class="line">
        <?php Pjax::begin(); ?>    
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    // 'id',
                    'nomor_surat',
                    [
                        'attribute' => 'tanggal_surat',
                        'value' => function($model)
                        {
                            return date('d-m-Y', strtotime($model->tanggal_surat));
                        }
                    ],
                    'pembuat',
                    'tujuan_surat',
                    'perihal',
                    'keterangan',
                    [
                        'attribute'=>'file_surat',
                        'format'=>'raw',
                        'value' => function($data)
                        {
                            return
                            Html::a('Download file', ['surat-keluar/download', 'id' => $data->id], ['class' => 'btn btn-primary']);

                        }
                    ],

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?>
    </div>
</div>
</div>

