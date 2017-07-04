<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PenggunaanAlat */

$this->title = 'Update Penggunaan Alat: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Penggunaan Alats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="penggunaan-alat-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('//penggunaan-alat/_form', [
        'model' => $model,
        'pengguna' => $pengguna,
    ]) ?>

</div>
