<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\PemohonAnalisis */

$this->title = 'Update Pemohon Analisis: '/* . $model->id*/;
$this->params['breadcrumbs'][] = ['label' => 'Pemohon Analises', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="pemohon-analisis-update">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('//pemohon-analisis/_form', [
        'model' => $model,
        'pemohon' => $pemohon,
    ]) ?>

</div>
