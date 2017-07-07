<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Sampel */

$this->title = 'Update Sampel: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Sampels', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="sampel-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
