<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\ChemStorage */

$this->title = 'Reagen Baru';
$this->params['breadcrumbs'][] = ['label' => 'Chem Storages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chem-storage-create">

    <!--<h1><?= Html::encode($this->title) ?></h1>-->

    <?= $this->render('_form', [
        'model' => $model,
        'modelsReagen' => $modelsReagen,
    ]) ?>

</div>
