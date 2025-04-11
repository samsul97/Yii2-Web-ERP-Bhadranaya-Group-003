<?php

use backend\models\MrInParent;
use backend\models\MrInType;
use backend\models\MrInUnit;
use backend\models\TbInventory;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;
use barcode\barcode\BarcodeGenerator;

$this->registerCssFile('@web/dist/css/dataTables.bootstrap4.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/dataTables.bootstrap4.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$select_unit = ArrayHelper::map(MrInUnit::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
$select_type = ArrayHelper::map(MrInType::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
$select_parent = ArrayHelper::map(MrInParent::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbInventorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Inventori Bahan Baku';
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
            <div class="tb-inventory-index">
                <?= Html::a('<i class="fa fa-barcode"> Print Barcode</i>', ['print-barcode'], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('<i class="fa fa-file"> Report</i>', ['report'], ['class' => 'btn btn-info']) ?>
                <p>
                    <?php
                    $level = Yii::$app->user->identity->level;
                    if ($level == '6fb4f22992a0d164b77267fde5477248') {
                        echo Html::a('Tambah Inventori', ['create'], ['class' => 'btn btn-success']);
                    }
                    ?>
                </p>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <div class="table-responsive table-nowrap">
                    <?php
                        $gridColumns = [
                            // [
                            //     'class' => 'yii\grid\SerialColumn',
                            //     'header' => 'No',
                            //     'headerOptions' => ['style' => 'text-align:center'],
                            //     'contentOptions' => ['style' => 'text-align:center']
                            // ],
                            // 'sku',
                            [
                                'format' => 'raw',
                                'label' => 'Barcode',
                                'attribute' => 'sku',
                                'value' => function($model) {
                                    $optionsArray = array(
                                        'elementId'=> 'showBarcode' . '-' . $model->sku,
                                        'value'=> $model->sku,
                                        'type'=>'code128',
                                    );
                                    BarcodeGenerator::widget($optionsArray);
                                    // if ($model->is_condition == "Broken") {
                                    //     return '<div id="showBarcode-'.$model->sku.'"></div>';
                                    // }
                                    // else {
                                        return Html::a('<div id="showBarcode-'.$model->sku.'"></div>');
                                    // }
                                }
                            ],
                            // 'desc',
                            [
                                'format' => 'raw',
                                'attribute' => 'desc',
                                'value' => function($model) {
                                    return Html::a($model->desc, ['costcontrol', 'id' => $model->id]);
                                }
                            ],
                            // [
                            //     'format' => 'raw',
                            //     'headerOptions' => ['style' => 'text-align:center'],
                            //     'contentOptions' => ['style' =>'text-align:center;'],
                            //     'attribute' => 'id_in_parent',
                            //     'filter' => $select_parent,
                            //     'value' => function ($data) {
                            //         $parent = MrInParent::findOne($data['id_in_parent']);
                            //         return $parent['name'];
                            //     },
                            // ],
                            // [
                            //     'format' => 'raw',
                            //     'headerOptions' => ['style' => 'text-align:center'],
                            //     'contentOptions' => ['style' =>'text-align:center;'],
                            //     'attribute' => 'id_in_unit',
                            //     'filter' => $select_unit,
                            //     'value' => function ($data) {
                            //         $unit = MrInUnit::findOne($data['id_in_unit']);
                            //         return $unit['name'];
                            //     },
                            // ],
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
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Opsi',
                                'template' => '{view}',
                                'buttons' => [
                            //         'update' => function($url, $model) {
                            //                 return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-edit"></i></button>', 
                            //                 ['update', 'id' => $model['id']], 
                            //                 ['title' => 'View', 'data' => 
                            //                 ['pjax' => 1]
                            //             ]);
                            //         },
                                    'view' => function($url, $model) {
                                        return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                                            ['view', 'id' => $model['id']], 
                                            ['title' => 'View', 'data' => 
                                            ['pjax' => 1]
                                        ]);
                                    },
                            //         'delete' => function($url, $model) {
                            //             return Html::a('<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>', 
                            //                 ['delete', 'id' => $model['id']], 
                            //                 ['title' => 'Delete', 'class' => '', 'data' => 
                            //                 ['confirm' => 'Apakah anda ingin menghapus data ?', 'method' => 'post', 'pjax' => 1],
                            //             ]);
                            //         }
                                ]
                            ],
                        ];

                        echo ExportMenu::widget([
                            'filterModel' => $searchModel,
                            'columns' => $gridColumns,
                            'dataProvider' => $dataProvider,
                            'filename' => 'assets',
                            //'stream' => false,
                            //'linkPath' => false,
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

<?php

$js = <<< JS

var t = $('.table-inventory').DataTable({
    "order": [[ 3, "desc" ]],
    "scrollY": "200px",
    // "scrollX": "200px",
    "scrollCollapse": true,
    "paging": false,
    "columnDefs": [
        { "orderable": false, "targets": 0 }
      ]
});

t.on( 'order.dt search.dt', function () {
    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();

JS;

$css = <<< CSS

CSS;

$this->registerCss($css);
$this->registerJs($js);

?>