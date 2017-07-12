<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Peneliti */

$this->title = 'Invoice';
$this->params['breadcrumbs'][] = ['label' => 'Peneliti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
$label = 'Create';
?>
<div class="peneliti-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_formInvoice', [
        'model' => $model,
        'invoice' => $invoice,
        'modelsSampelInvoice' => $modelsSampelInvoice,
    ]) ?>

</div>
