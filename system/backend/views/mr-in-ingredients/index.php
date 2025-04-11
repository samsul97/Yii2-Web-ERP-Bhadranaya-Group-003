<?php

use backend\models\MrInUnit;
use backend\models\TbPurSupplier;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$select_unit = ArrayHelper::map(MrInUnit::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_supplier = ArrayHelper::map(TbPurSupplier::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MrInIngredientsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Bahan-Bahan Dapur';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="card table-card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <div class="mr-in-ingredients-index">
                <p>
                    <?= Html::a('Tambah Bahan', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <div class="table-responsive table-nowrap">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        // 'columns' => $gridColumns,
                        'columns' => [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'header' => 'No',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' => 'text-align:center']
                            ],
                            'name',
                            // 'timestamp',
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center;'],
                                'attribute' => 'id_supplier',
                                'filter' => $select_supplier,
                                'value' => function ($data) {
                                    $supplier = TbPurSupplier::findOne($data['id_supplier']);
                                    return $supplier['name'];
                                },
                            ],
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center;'],
                                'attribute' => 'id_in_unit',
                                'filter' => $select_unit,
                                'value' => function ($data) {
                                    $unit = MrInUnit::findOne($data['id_in_unit']);
                                    return $unit['name'];
                                },
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Action',
                                'template' => '{update} {view}',
                                'buttons' => [
                                    'view' => function($url, $model) {
                                        return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                                            ['view', 'id' => $model['id']], 
                                            ['title' => 'View', 'data' => 
                                            ['pjax' => 1]
                                        ]);
                                    },
                                    'update' => function($url, $model) {
                                        return Html::a('<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>', 
                                            ['update', 'id' => $model['id']], 
                                            ['title' => 'Update', 'data' => 
                                            ['pjax' => 1]
                                        ]);
                                    },
                                    // 'delete' => function($url, $model) {
                                    //     return Html::a('<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>', 
                                    //         ['delete', 'id' => $model['id']], 
                                    //         ['title' => 'Delete', 'class' => '', 'data' => 
                                    //         ['confirm' => 'Apakah anda ingin menghapus data ?', 'method' => 'post', 'pjax' => 1],
                                    //     ]);
                                    // }
                                    // 'detail' => function($url, $model) {
                                    //     return Html::a('<button class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i></button>', 
                                    //         ['detail', 'id' => $model['id']], 
                                    //         ['title' => 'View', 'data' => 
                                    //         ['pjax' => 1]
                                    //     ]);
                                    // },
                                ]
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
