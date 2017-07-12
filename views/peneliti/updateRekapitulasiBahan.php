<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Peneliti */

$this->title = 'Update Invoice: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Rekapitulasi Bahan', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
$label = 'Update';
?>
<div class="peneliti-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_formRekapitulasiBahan', [
        'model' => $model,
        'modelsBahan' => $modelsBahan,
        'label' => $label,
    ]) ?>

</div>
