<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Reagen */

$this->title = 'Create Reagen';
$this->params['breadcrumbs'][] = ['label' => 'Reagens', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="reagen-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
