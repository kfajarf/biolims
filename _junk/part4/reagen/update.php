<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Reagen */

$this->title = 'Update Reagen: ' . $model->id_bahan;
$this->params['breadcrumbs'][] = ['label' => 'Reagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id_bahan, 'url' => ['view', 'id' => $model->id_bahan]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="reagen-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
