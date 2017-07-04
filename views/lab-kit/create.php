<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\LabKit */

$this->title = 'Create Lab Kit';
$this->params['breadcrumbs'][] = ['label' => 'Lab Kits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="lab-kit-create">

    <!-- <h1><?= Html::encode($this->title) ?></h1> -->

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
