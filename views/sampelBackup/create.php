<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Sampel */

$this->title = 'Create Sampel';
$this->params['breadcrumbs'][] = ['label' => 'Sampels', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="sampel-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
