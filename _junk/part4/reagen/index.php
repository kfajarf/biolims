<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\ReagenSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Reagens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reagen-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Reagen', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id_bahan',
            'nama_bahan',
            'jenis_bahan',
            'jumlah',
            'jumlah_minimum',
            // 'unit',
            // 'tanggal_kadaluarsa',
            // 'id_lokasi',
            // 'id_supplier',
            // 'status',
            // 'id_storage',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
