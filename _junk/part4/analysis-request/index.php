<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel app\models\AnalysisRequestSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Analysis Requests';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analysis-request-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Analysis Request', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <div style="overflow-x: auto; white-space: nowrap;">
    <?php Pjax::begin(); ?>
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],

                'lpsb_order_no',
                'tanggal_diterima',
                'id_pemohon',
                'id_sampel',
                'id_pengujian',
                'total_biaya',
                'dp',
                'sisa',

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]); ?>
    <?php Pjax::end(); ?>
    </div>
</div>
