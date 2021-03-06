<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\AnalysisRequest */

$this->title = 'Create Analysis Request';
$this->params['breadcrumbs'][] = ['label' => 'Analysis Requests', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="analysis-request-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'pemohon' => $pemohon,
        'sampel' => $sampel,
    ]) ?>

</div>
