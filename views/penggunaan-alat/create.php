<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PenggunaanAlat */

$this->title = 'Create Penggunaan Alat';
$this->params['breadcrumbs'][] = ['label' => 'Penggunaan Alats', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="penggunaan-alat-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
