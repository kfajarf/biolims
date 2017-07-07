<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PenelitiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Penelitis';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peneliti-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Peneliti', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
<?php Pjax::begin(); ?>    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            'nama_lengkap',
            'tempat_tanggal_lahir',
            'institusi',
            'nrp_nim',
            // 'no_handphone',
            // 'email:email',
            // 'alamat_dan_no_telp_bogor',
            // 'alamat_dan_no_telp_orang_tua',
            // 'judul_penelitian',
            // 'tanggal_masuk_lpsb',
            // 'uang_masuk_lpsb',
            // 'deposit_lpsb',
            // 'keterangan',
            // 'biaya_hasil_rekapitulasi',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
<?php Pjax::end(); ?></div>
