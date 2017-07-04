<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\controllers\LabKitController;
use app\controllers\PenggunaanAlatController;
use app\models\LabKit; 
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $searchModel app\models\LabKitSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

/*foreach ($models as $model) {
    echo ($model->nama_alat .'<br>');
}*/
/*$today = date('Y-m-d');
$model = \app\models\PenggunaanAlat::find()->where(['not', ['kit_id' => NULL]])->andWhere(['>', 'tanggal_penggunaan', $today])->orderBy(['tanggal_penggunaan' => SORT_ASC])->all();*/
// $today = date('Y-m-d');
// var_dump(Yii::$app->controller->action->id);
// die();

$this->title = 'Lab Kits';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-kit-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::button('Tambah Peralatan', ['value' => Url::to('/lab-kit/create'), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
        <?= Html::a('Daftar Peminjaman Alat', ['list-peminjaman'], ['class' => 'btn btn-default']) ?>
    </p>

    <?php 
        Modal::begin([
            'header' => '<h4>Alat Baru</h4>',
            'id' => 'modal',
            'size' => 'modal-md',
        ]);

        echo "<div id='modalContent'></div>";
        Modal::end();
     ?>

    <div class= "row" style="padding: 15px">
    <div style="border-top: 7px solid rgba(0, 100, 170, 1); overflow-x: auto; white-space: nowrap; background-color: white; padding: 10px 10px 0px 10px">
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        //'filterModel' => $searchModel,
        'rowOptions' => function($model)
        {  
            $flag = LabKitController::checkDate($model->id);
            $today = date('Y-m-d');
            $usedFlag = $model->status_penggunaan;
            if($usedFlag == "digunakan" && $model->kalibrasi_selanjutnya == $today)
            {
                return ['class' => 'danger'];
            } else if ($usedFlag == "digunakan" || $model->kalibrasi_selanjutnya == $today){
                return ['class' => 'warning'];
            }
            else return ['class' => 'success'];
        },
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'nama_alat',
            //'jangka_kalibrasi',
            //'tanggal_mulai',
            [
                'attribute' => 'kalibrasi_selanjutnya',
                'value' => function($model)
                {
                    $today = date('Y-m-d');
                    if($today > $model->kalibrasi_selanjutnya)
                    {
                        LabKitController::resetSchedule($model->id); 
                    }
                    return $model->kalibrasi_selanjutnya;
                }
            ],
            [
                'attribute' => 'status_penggunaan',
                'value' => function($model)
                {
                    LabKitController::checkStatus($model->id);
                    return $model->status_penggunaan;
                }
            ],
            [
                'attribute' => 'Penggunaan Selanjutnya',
                'value' => function($model)
                {
                    $today = date('Y-m-d');
                    $pengguna = \app\models\PenggunaanAlat::find()->where(['kit_id' => $model->id])->andWhere(['>', 'tanggal_penggunaan', $today])->orderBy(['tanggal_penggunaan' => SORT_ASC])->one();
                    if($pengguna != null)
                    {
                        if($pengguna->tanggal_penggunaan > $today)
                            return $pengguna->tanggal_penggunaan;
                        else return '-';
                    }
                    else return '-';                    
                }
            ],
            [
                'attribute' => 'keterangan',
                'value' => function($model)
                {
                    $today = date('Y-m-d');
                    // var_dump($today);die();
                    if($today == $model->kalibrasi_selanjutnya)
                    {
                    //     return ['class' => 'danger'];
                    // } else if ($flagStock || $flagExpired){
                        return "Peringatan Kalibrasi Alat";
                    } else {
                        return '-';
                    }
                }
            ],

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    </div>
</div>
