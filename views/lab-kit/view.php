<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\bootstrap\Modal;

/* @var $this yii\web\View */
/* @var $model app\models\LabKit */

$this->title = '';
$this->params['breadcrumbs'][] = ['label' => 'Alat Laboratorium', 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->id;
?>
<div class="lab-kit-view">

    <!--h1><?= Html::encode($this->title) ?></h1-->

    <p>
        <!-- <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?> -->
        <?= Html::button('Update', ['value' => Url::to(['update', 'id' => $model->id]), 'class' => 'btn btn-primary', 'id' => 'modalButton']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    <?php 
        Modal::begin([
            'header' => '<h4>Update Alat</h4>',
            'id' => 'modal',
            'size' => 'modal-md',
        ]);

        echo "<div id='modalContent'></div>";
        Modal::end();
    ?>

    <div class= "row" style="padding: 15px">
        <div class="col-md-8" style="border-top: 7px solid rgba(0, 100, 170, 1); overflow-x: auto; white-space: nowrap; background-color: white; padding: 20px 20px 0px 20px">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'nama_alat',
                    'jangka_kalibrasi',
                    'tanggal_mulai',
                    'kalibrasi_selanjutnya',
                    'status_penggunaan',
                ],
            ]) ?>
        </div>
    </div>
</div>
