<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peneliti */

$this->title = 'Update Kwitansi: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Kwitansi', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$label = 'Update';
?>
<div class="peneliti-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_formKwitansi', [
        'model' => $model,
        'kwitansi' => $kwitansi,
    ]) ?>

</div>
