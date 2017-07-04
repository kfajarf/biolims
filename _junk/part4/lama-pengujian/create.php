<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LamaPengujian */

$this->title = 'Create Lama Pengujian';
$this->params['breadcrumbs'][] = ['label' => 'Lama Pengujians', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lama-pengujian-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
