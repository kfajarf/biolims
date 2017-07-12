<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ChemStorageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Chem Storages';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="chem-storage-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Chem Storage', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'class' => 'kartik\grid\ExpandRowColumn',
                'value' => function($model, $key, $index, $column)
                {
                    return GridView::ROW_COLLAPSED;
                },
                'detail' => function($model, $key, $index, $column)
                {
                    $searchModel = new ReagenSearch();
                    $searchModel -> id = $model -> id;
                    $dataProvider = $searchModel -> search(Yii::$app-> request-> queryParams);

                    return Yii::$app-> controller-> renderPartial('_reagenList', [
                        'searchModel' => $searchModel,
                        'dataProvider' => $dataProvider,
                    ]);
                },
            ],

            'id',
            'pemilik',
            'tanggal_masuk',
            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{deleteLog},{view},{delete}',
                'buttons' => [
                    'deleteLog' => function($url, $model){
                        $url = Url::to(['lab-kit/delete-log', 'id' => $model->id]);
                        return Html::a('<span class="fa fa-trash"></span>', $url, [
                            'title' => 'delete',
                            'data-confirm' => Yii::t('yii', 'hapus jadwal penggunaan?'),
                            'data-method' => 'post',
                        ]);
                    },
                ],
            ],
        ],
    ]); ?>
</div>
