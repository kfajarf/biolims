<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\JenisBahan */

$this->title = 'Update Jenis Bahan: ' . $model->id_jenis_bahan;
$this->params['breadcrumbs'][] = ['label' => 'Jenis Bahans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_jenis_bahan, 'url' => ['view', 'id' => $model->id_jenis_bahan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="jenis-bahan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
