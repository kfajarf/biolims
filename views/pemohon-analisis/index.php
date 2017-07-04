<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\PemohonAnalisisSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Pemohon Analises';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemohon-analisis-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Pemohon Analisis', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama_lengkap',
            'institusi_perusahaan',
            'alamat:ntext',
            'telp_fax',
            'no_hp',
            'email:email',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
