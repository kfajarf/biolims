<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\JenisBahanSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jenis Bahans';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="jenis-bahan-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Jenis Bahan', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_jenis_bahan',
            'jenis_bahan',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
