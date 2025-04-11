<?php

use backend\models\TbAssets;
use backend\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;
// use kartik\detail\DetailView;
use yii\helpers\ArrayHelper;


$select_user = ArrayHelper::map(User::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_assets = ArrayHelper::map(TbAssets::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name']. '-' .$model['sku'];
}
);

/* @var $this yii\web\View */
/* @var $model backend\models\TbAssets */

$this->title = $model->condition_issue;
$this->params['breadcrumbs'][] = ['label' => 'Jejak Kerusakan Barang', 'url' => ['broken']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
            <div class="tb-assets-view">
                <?= DetailView::widget([
                    'model' => $model,
                    'template' => '<tr><th width="180px" style="text-align:right">{label}</th><td>{value}</td></tr>',
                    'attributes' => [
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
                        'qty_broken',
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
                            'attribute' => 'is_sale_price',
                            'format' => 'raw',
                            'visible' => $model->status == NULL ? false : true,
                            'value' => function($model) {
                                if ($model->is_sale_price == NULL) {
                                    return 'Belum diset';
                                }
                                else {
                                    return '<b> Rp.' . number_format($model->is_sale_price, 2) . '</b>';
                                }
                            }
                        ],
                        [
                            'attribute' => 'is_sale_where',
                            'format' => 'raw',
                            'visible' => $model->status == NULL ? false : true,
                            'value' => function($model) {
                                if ($model->is_sale_where == '') {
                                    return 'Belum diset';
                                }
                                return $model->is_sale_where;
                            }
                        ],
                        [
                            'attribute' => 'is_sale_date',
                            'format' => 'raw',
                            'visible' => $model->status == NULL ? false : true,
                            'value' => function($model) {
                                if ($model->is_sale_date == NULL) {
                                    return 'Belum diset';
                                }
                                return $model->is_sale_date;
                            }
                        ],
                        [
                            'attribute' => 'is_waste_where',
                            'format' => 'raw',
                            'visible' => $model->status == NULL ? false : true,
                            'value' => function($model) {
                                return $model->is_waste_where;
                            }
                        ],
                        [
                            'attribute' => 'is_waste_date',
                            'format' => 'raw',
                            'visible' => $model->status == NULL ? false : true,
                            'value' => function($model) {
                                return $model->is_waste_date;
                            }
                        ],
                        // 'is_sale_price',
                        // 'is_sale_where',
                        // 'is_sale_date',
                        // 'is_waste_where',
                        // 'is_waste_date',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>