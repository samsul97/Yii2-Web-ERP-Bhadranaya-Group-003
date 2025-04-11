<?php

use backend\models\TbPurProducts;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$select_product = ArrayHelper::map(TbPurProducts::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbMarDiscountSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Discount';
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
            <div class="tb-mar-discount-index">
                <p>
                    <?= Html::a('Tambah Discount', ['create'], ['class' => 'btn btn-success']) ?>
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
                                // 'id_products',
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center;'],
                                'attribute' => 'id_products',
                                'filter' => $select_product,
                                'value' => function ($data) {
                                    $product = TbPurProducts::findOne($data['id_products']);
                                    return $product['name'];
                                },
                            ],
                                'start_date',
                                'end_date',
                            [
                                'format' => 'raw',
                                'headerOptions' => [],
                                'contentOptions' => [],
                                'attribute' => 'percent',
                                'value' => function($model) {
                                    return '<b>' . $model->percent . '%' . '</b>';
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Action',
                                'template' => '{view}, {update}',
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
                                    // 'detail' => function($model) {
                                    //     return Html::a('<button class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i></button>',
                                    //     ['detail', 'id_detail' => $model['id']],
                                    //     ['title' => 'Detail Info', 'class' => 'detailsProgram', 'data' => ['pjax' => 1]
                                    //     ]);
                                    // }
                                    // 'detail' => function($url, $model) {
                                    //     return Html::a('<button class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i></button>', 
                                    //         ['detail', 'id' => $model['id']], 
                                    //         ['title' => 'View', 'class' => 'detailsprogram', 'data' => 
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