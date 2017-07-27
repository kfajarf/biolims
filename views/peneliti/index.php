<?php
namespace app\models;

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\ArrayHelper;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PenelitiSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = '';
$this->params['breadcrumbs'][] = 'Penelitian';
?>
<div class="peneliti-index">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Isi Form Penelitian', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
<div class= "row" style="padding: 15px">
    <div class="line">
        <?php Pjax::begin(); ?>    
            <?= GridView::widget([
                'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                /*[
                    'attribute' => 'id',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ]
                ],*/
                [
                    'attribute' => 'nama_lengkap',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ]
                ],
                [
                    'attribute' => 'tempat_tanggal_lahir',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ]
                ],
                [
                    'attribute' => 'institusi',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ]
                ],
                [
                    'attribute' => 'departemen_id',
                    'value' => 'departemen.nama_departemen',
                    'filter' => Html::activeDropDownList($searchModel, 'departemen_id', ArrayHelper::map(Departemen::find()->asArray()->all(), 'id', 'nama_departemen'), ['class' => 'form-control', 'prompt' => '-- Departemen --']),
                ],
                [
                    'attribute' => 'nrp_nim',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ]
                ],
                    // 'no_handphone',
                    // 'email:email',
                    // 'alamat_dan_no_telp_bogor',
                    // 'alamat_dan_no_telp_orang_tua',
                /*[
                    'attribute' => 'judul_penelitian',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ]
                ],*/
                [
                    'attribute' => 'tanggal_masuk_lpsb',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ],
                    'value' => function($model)
                    {
                        return date('d-m-Y', strtotime($model->tanggal_masuk_lpsb));
                    }
                ],

                    // 'uang_masuk_lpsb',
                [
                    'attribute' => 'deposit_lpsb',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ]
                ],
                [
                    'attribute' => 'status',
                    'filterInputOptions' => [
                    'class'       => 'form-control',
                    'placeholder' => 'Pencarian'
                    ],
                    'value' => function($model)
                    {
                        $kwitansi = \app\models\Kwitansi::findOne(['id_peneliti' => $model->id]);
                        if ($kwitansi != NULL) {
                            $model->status = 'lunas';
                            $model->save();
                        }
                        return $model->status;
                    }
                ],
                    // 'keterangan',
                    // 'biaya_hasil_rekapitulasi',

                    ['class' => 'yii\grid\ActionColumn'],
                ],
            ]); ?>
        <?php Pjax::end(); ?></div>
    </div>
</div>
