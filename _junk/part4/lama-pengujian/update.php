<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\LamaPengujian */

$this->title = 'Update Lama Pengujian: ' . $model->id_pengujian;
$this->params['breadcrumbs'][] = ['label' => 'Lama Pengujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_pengujian, 'url' => ['view', 'id' => $model->id_pengujian]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="lama-pengujian-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
