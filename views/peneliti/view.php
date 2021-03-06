<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;
use yii\grid\GridView;
use yii\bootstrap\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model app\models\Peneliti */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Peneliti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
$rekapBahan = \app\models\RekapitulasiBahan::findAll(['id_peneliti' => $model->id]);
$invoiceItem = \app\models\Invoice::find()->where(['id_peneliti' => $model->id])->one();
$kwitansiItem = \app\models\Kwitansi::find()->where(['id_peneliti' => $model->id])->one();
if($rekapBahan == NULL) {
    $url = 'create-rekapitulasi-bahan';
} else $url = 'update-rekapitulasi-bahan';
if($invoiceItem == NULL) {
    $urlInvoice = 'create-invoice';
} else $urlInvoice = 'update-invoice';
if($kwitansiItem == NULL) {
    $urlKwitansi = 'create-kwitansi';
} else $urlKwitansi = 'update-kwitansi';
?>
<div class="peneliti-view">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
        <?= Html::a('Rekapitulasi Bahan', [$url, 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?php
            if($rekapBahan != NULL){
                if($invoiceItem == NULL) 
                {
                    echo Html::a('Buat Invoice', [$urlInvoice, 'id' => $model->id], ['class' => 'btn btn-primary']);
                } else {
                    echo Html::a('Update Invoice', [$urlInvoice, 'id' => $model->id], ['class' => 'btn btn-primary']);
                    echo Html::a('<i class="fa fa-download"></i> Unduh Invoice', ['invoice-pdf', 'id' => $model->id], [
                        'class'=>'btn btn-default', 
                        'target'=>'_blank',
                    ]); 
                }
            }
        ?>
        <?php
            if($invoiceItem != NULL){
                if($kwitansiItem == NULL) 
                {
                    echo Html::button('Buat Kwitansi', ['value' => Url::to('/peneliti/create-kwitansi?id='.($model->id)), 'class' => 'btn btn-primary', 'id' => 'modalButton']);
                } else {
                    echo Html::a('Update Kwitansi', [$urlKwitansi, 'id' => $model->id], ['class' => 'btn btn-primary']);
                    echo Html::a('<i class="fa fa-download"></i> Unduh Kwitansi', ['kwitansi-pdf', 'id' => $model->id], [
                        'class'=>'btn btn-default', 
                        'target'=>'_blank',
                    ]); 
                }
            }
        ?>
        <?php 
            Modal::begin([
                'header' => '<h4>Kwitansi</h4>',
                'id' => 'modal',
                'size' => 'modal-sm',
            ]);

            echo "<div id='modalContent'></div>";
            Modal::end();
         ?>
    </p>
    
<div class= "row" style="padding: 15px">
    <div class= "line col-md-10">
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'nama_lengkap',
            'tempat_tanggal_lahir',
            'institusi',
            [
                'label' => 'Nama Departemen',
                'value' => $model->departemen->nama_departemen,
            ],
            'nrp_nim',
            'no_handphone',
            'email:email',
            'alamat_dan_no_telp_bogor',
            'alamat_dan_no_telp_orang_tua',
            [
                'label' => 'Nama Pembimbing',
                'value' => $model->namaPembimbing,
            ],
            [
                'label' => 'Tempat Penelitian',
                'value' => $model->namaTempat,
            ],
            'judul_penelitian',
            [
                'label' => 'Tanggal Masuk LPSB',
                'value' => date('d-m-Y', strtotime($model->tanggal_masuk_lpsb)),
            ],
            'uang_masuk_lpsb',
            'deposit_lpsb',
            'keterangan',
            // 'biaya_hasil_rekapitulasi',
        ],
    ]) ?>
</div>
    </div>

<?php if($rekapBahan != NULL): ?>
    <div class= "row" style="padding: 15px">
        <div class= "line col-md-10">
            <?php Pjax::begin(); ?>    
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'columns' => [
                        ['class' => 'yii\grid\SerialColumn'],

                        'nama_bahan',
                        'jumlah',
                        'spesifikasi',

                        'harga', 
                        'keterangan',
                    ],
                ]); ?> 
            <?php Pjax::end(); ?></div>
        </div>
    </div>
<?php endif; ?>
</div>
