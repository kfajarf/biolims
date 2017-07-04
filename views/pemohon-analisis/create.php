<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PemohonAnalisis */

$this->title = 'Create Pemohon Analisis';
$this->params['breadcrumbs'][] = ['label' => 'Pemohon Analises', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="pemohon-analisis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
