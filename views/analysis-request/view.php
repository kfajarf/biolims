<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use app\models\SampelSearch;

/* @var $this yii\web\View */
/* @var $model app\models\AnalysisRequest */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Analysis Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->lpsb_order_no;
?>

<div class="analysis-request-view">

    <!--h1><?= Html::encode($this->title) ?></h1-->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('<i class="fa fa-download"></i> Download Form Permohonan Analisis', ['permohonan-analisis', 'id' => $model->id], [
            'class'=>'btn btn-default', 
            'target'=>'_blank',
        ]); ?>
        <?= Html::a('<i class="fa fa-download"></i> Download Form Tanda Terima Sampel', ['tanda-terima-sampel', 'id' => $model->id], [
            'class'=>'btn btn-default', 
            'target'=>'_blank',
        ]); ?>
        <?php
            $kajiUlang = \app\models\KajiUlang::find()->where(['request_id' => $model->id])->one();
            if($kajiUlang == NULL) 
            {
                echo Html::a('Buat Form Kaji Ulang', ['kaji-ulang', 'id' => $model->id], ['class' => 'btn btn-primary']);
            } else {
                echo Html::a('<i class="fa fa-download"></i> Download Form Kaji Ulang', ['kaji-ulang-pdf', 'id' => $model->id], [
                    'class'=>'btn btn-default', 
                    'target'=>'_blank',
                ]); 
            }
        ?>
    </p>
    <div class="row" style="padding: 15px">
    <div class="line col-md-10" >
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'lpsb_order_no',
            [
                'attribute' => 'nama_lengkap',
                'value' => $pemohon->nama_lengkap,
            ],
            [
                'attribute' => 'institusi_perusahaan',
                'value' => $pemohon->institusi_perusahaan,
            ],
            [
                'attribute' => 'alamat',
                'value' => $pemohon->alamat,
            ],
            [
                'attribute' => 'telp_fax',
                'value' => $pemohon->telp_fax,
            ],
            [
                'attribute' => 'no_hp',
                'value' => $pemohon->no_hp,
            ],
            [
                'attribute' => 'email',
                'value' => $pemohon->email,
            ],
            'status_pengujian',
            'tanggal_diterima',
            'tanggal_selesai',
            [
                'attribute' => 'total_biaya',
                'value' => \Yii::$app->formatter->format($model->total_biaya, ['decimal', 0]),
            ],
            [
                'attribute' => 'dp',
                'value' => \Yii::$app->formatter->format($model->dp, ['decimal', 0]),
            ],
            [
                'attribute' => 'sisa',
                'value' => \Yii::$app->formatter->format($model->sisa, ['decimal', 0]),
            ],
            'keterangan:ntext',
            'status',
        ],
    ]) ?>
        </div>
    </div>

</div>

