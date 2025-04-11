<?php

use backend\models\MrInType;
use backend\models\TbInventory;
use backend\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;

$select_inventory = ArrayHelper::map(TbInventory::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['desc'];
}
);

$select_user = ArrayHelper::map(User::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_type = ArrayHelper::map(MrInType::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbEmpLeaveSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Laporan Inventori';
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
            <div class="tb-inventory-report">
                <div class="table-responsive table-nowrap">
                <?php echo $this->render('_search', ['model' => $searchModel]); ?>
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
                            'attribute' => 'id_inventory',
                            'filter' => $select_inventory,
                            'value' => function ($data) {
                                $inv = TbInventory::findOne($data['id_inventory']);
                                return $inv['sku']. '-' . $inv['desc'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_in_type',
                            'filter' => $select_type,
                            'value' => function ($data) {
                                $type = MrInType::findOne($data['id_in_type']);
                                return $type['name'];
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
                        'in_arrival',
                        'in_selling',
                        'out_sales',
                        'out_non_sales',
                        'waste',
                        'spoiled',
                        'remarks',
                        'last_stock',
                        'updated_at',
                        // [
                        //     'class' => 'yii\grid\ActionColumn',
                        //     'header' => '',
                        //     'template' => '',
                        //     'buttons' => [
                        //         'view' => function($url, $model) {
                        //             return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                        //                 ['view', 'id' => $model['id']], 
                        //                 ['title' => 'View', 'data' => 
                        //                 ['pjax' => 1]
                        //             ]);
                        //         },
                        //         'update' => function($url, $model) {
                        //             return Html::a('<button class="btn btn-sm btn-success"><i class="fa fa-edit"></i></button>', 
                        //                 ['update', 'id' => $model['id']], 
                        //                 ['title' => 'Update', 'data' => 
                        //                 ['pjax' => 1]
                        //             ]);
                        //         },
                        //         'delete' => function($url, $model) {
                        //             return Html::a('<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>', 
                        //                 ['delete', 'id' => $model['id']], 
                        //                 ['title' => 'Delete', 'class' => '', 'data' => 
                        //                 ['confirm' => 'Apakah anda ingin menghapus data ?', 'method' => 'post', 'pjax' => 1],
                        //             ]);
                        //         }
                        //     ]
                        // ],
                    ];

                    echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns,
                        'filename' => 'Laporan Inventori',
                        'batchSize' => 1024,
                    ]);

                    ?>
                    <?= GridView::widget([
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