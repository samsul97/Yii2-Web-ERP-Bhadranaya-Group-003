<?php

use backend\models\TbAssets;
use backend\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;

$select_user = ArrayHelper::map(User::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_assets = ArrayHelper::map(TbAssets::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name']. '-' .$model['sku'];
}
);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbAssetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jejak Kerusakan Barang';
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
            <div class="tb-assets-index">
                <p>
                    <?= Html::a('Tambah Kerusakan Barang', ['create-broken'], ['class' => 'btn btn-success']) ?>
                </p>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <div class="table-responsive table-nowrap">
                    <?php
                        $gridColumns = [
                            [
                                'class' => 'yii\grid\SerialColumn',
                                'header' => 'No',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' => 'text-align:center']
                            ],
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center;'],
                                'attribute' => 'id_tb_assets',
                                'filter' => $select_assets,
                                'value' => function ($data) {
                                    $assets = TbAssets::findOne($data['id_tb_assets']);
                                    return $assets['name']. '-' .$assets['sku'];
                                },
                            ],
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center;'],
                                'attribute' => 'id_user',
                                'filter' => $select_user,
                                'value' => function ($data) {
                                    $user = User::findOne($data['id_user']);
                                    return $user['name'];
                                },
                            ],
                            'qty_broken',
                            [
                                'attribute' => 'is_condition',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    if ($model->is_condition == 'Abnormal') {
                                        return '<button class ="btn btn-danger btn-sm">' . 'RUSAK' . '</button>';
                                    }
                                },
                                'filter' => [
                                    'Broken' => 'Rusak',
                                ],
                            ],
                            'condition_issue',
                            'dob',
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function($model) {
                                    if ($model->status == NULL) {
                                        return Html::a('<button class="btn btn-sm btn-light">Belum diset</button>', 
                                            ['update-broken', 'id' => $model['id']], 
                                            ['title' => 'Update Status', 'data' => 
                                            ['pjax' => 1]
                                        ]);
                                    }
                                    if ($model->status == 'Dijual') {
                                        return Html::a('<button class="btn btn-sm btn-success">Dijual</button>');
                                    }
                                    if ($model->status == 'Dibuang') {
                                        return Html::a('<button class="btn btn-sm btn-danger">Dibuang</button>');
                                    }
                                }
                            ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Opsi',
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function($url, $model) {
                                        return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                                            ['view-broken', 'id' => $model['id']], 
                                            ['title' => 'View', 'data' => 
                                            ['pjax' => 1]
                                        ]);
                                    },
                                    // 'update' => function($url, $model) {
                                    //     return Html::a('<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>', 
                                    //         ['update', 'id' => $model['id']], 
                                    //         ['title' => 'Update', 'data' => 
                                    //         ['pjax' => 1]
                                    //     ]);
                                    // },
                                    // 'delete' => function($url, $model) {
                                    //     return Html::a('<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>', 
                                    //         ['delete', 'id' => $model['id']], 
                                    //         ['title' => 'Delete', 'class' => '', 'data' => 
                                    //         ['confirm' => 'Apakah anda ingin menghapus data ?', 'method' => 'post', 'pjax' => 1],
                                    //     ]);
                                    // }
                                ]
                            ],
                        ];
                        echo ExportMenu::widget([
                            'filterModel' => $searchModel,
                            'columns' => $gridColumns,
                            'dataProvider' => $dataProvider,
                            'filename' => 'Barang Rusak',
                            'batchSize' => 1024,
                        ]);

                        echo GridView::widget([
                            'dataProvider' => $dataProvider,
                            'filterModel' => $searchModel,
                            'columns' => $gridColumns,
                        ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>