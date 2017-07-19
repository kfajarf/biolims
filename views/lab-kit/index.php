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
            if($usedFlag == "digunakan" && $model->status_kalibrasi == 'belum dikalibrasi')
            {
                return ['class' => 'danger'];
            } else if ($usedFlag == "digunakan" || $model->status_kalibrasi == 'belum dikalibrasi'){
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
                'format' => 'raw',
                'value' => function($model)
                {
                    $today = date('Y-m-d');
                    // var_dump($today);die();
                    if(!$model->kalibrasi_per_hari && $today == $model->kalibrasi_selanjutnya && $model->status_kalibrasi == 'sudah dikalibrasi'){
                        \app\controllers\LabKitController::indexKalibrasi($model->id);
                    } else if ($today > $model->kalibrasi_selanjutnya) {
                        $model->kalibrasi_per_hari = 0;
                        $model->save();                        
                    } else if ($model->status_kalibrasi == 'belum dikalibrasi') {
                        return "Peringatan Kalibrasi Alat";
                    } else return date('d-m-Y', strtotime($model->kalibrasi_selanjutnya));
                }
            ],
            [
                'attribute' => '',
                'format' => 'raw',
                'value' => function($model)
                {
                    $today = date('Y-m-d');
                    // var_dump($today);die();
                    if($model->status_kalibrasi == 'belum dikalibrasi'){
                            return Html::a('Kalibrasi Alat',['reset-schedule', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    } else {
                        return '-';
                    }
                }
            ],
            /*[
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
            */
            [
                'attribute' => 'status_penggunaan',
            ],
            [
                'attribute' => '',
                'format'=>'raw',
                'value' => function($model)
                {
                    $today = date('Y-m-d');
                    // var_dump($today);die();
                    $pengguna = \app\models\PenggunaanAlat::find()->where(['kit_id' => $model->id, 'status_pengembalian_alat' => 'belum dikembalikan'])->orderBy(['tanggal_penggunaan' => SORT_ASC])->one();
                    // var_dump($pengguna == NULL);die(); 
                    if($pengguna != NULL){   
                        if(($today == $pengguna->tanggal_penggunaan))
                        {
                            \app\controllers\LabKitController::setStatusPenggunaan($model->id);
                        }
                    }
                    if($model->status_penggunaan == 'digunakan'){
                        return Html::a('Pengembalian Alat',['pengembalian-alat', 'id' => $pengguna->id], ['class' => 'btn btn-primary']); 
                    }
                    else return '-';
                }
            ],
            [
                'attribute' => 'Penggunaan Selanjutnya',
                'value' => function($model)
                {
                    $today = date('Y-m-d');
                    $pengguna = \app\models\PenggunaanAlat::find()->where(['kit_id' => $model->id, 'status_pengembalian_alat' => 'belum dikembalikan'])->andWhere(['>', 'tanggal_penggunaan', $today])->orderBy(['tanggal_penggunaan' => SORT_ASC])->one();
                    if($pengguna != null)
                    {
                        if($pengguna->tanggal_penggunaan > $today)
                            return date('d-m-Y', strtotime($pengguna->tanggal_penggunaan));
                        else return '-';
                    }
                    else return '-';                    
                }
            ],
            

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    </div>
    </div>
</div>
