<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Peneliti */

$this->title = 'Form Penelitian';
$this->params['breadcrumbs'][] = ['label' => 'Penelitis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="peneliti-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
        'modelsPembimbing' => $modelsPembimbing,
        'modelsTempat' => $modelsTempat,
    ]) ?>

</div>
