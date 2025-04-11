<?php

use backend\models\MrCompany;
use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$select_company = ArrayHelper::map(MrCompany::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbPurProductsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Produk';
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
            <div class="tb-pur-products-index">
                <p>
                    <?= Html::a('Tambah Produk', ['create'], ['class' => 'btn btn-success']) ?>
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
                            // 'id',
                            // 'id_company',
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center;'],
                                'attribute' => 'id_company',
                                'filter' => $select_company,
                                'value' => function ($data) {
                                    $company = MrCompany::findOne($data['id_company']);
                                    return $company['name'];
                                },
                            ],
                            'name',
                            // 'image',
                            'price',
                            //'created_at',
                            //'timestamp',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Action',
                                'template' => '{update} {detail}',
                                'buttons' => [
                                    // 'view' => function($url, $model) {
                                    //     return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                                    //         ['view', 'id' => $model['id']], 
                                    //         ['title' => 'View', 'data' => 
                                    //         ['pjax' => 1]
                                    //     ]);
                                    // },
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
                                    'detail' => function($url, $model) {
                                        return Html::a('<button class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i></button>', 
                                            ['detail', 'id' => $model['id']], 
                                            ['title' => 'View', 'class' => 'detailsproduct', 'data' => 
                                            ['pjax' => 1]
                                        ]);
                                    },
                                ]
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
// $css = <<< CSS
// .modal-lg {
//     width: 80%;
//     margin: 0 0 0 0;
//     border-radius: 0;
// }

// .modal-lg .modal-content {
//     border-radius: 0;
// }

// .modal.slide .modal-dialog {
//     -webkit-transition: -webkit-transform .3s ease-out;
//     -o-transition:      -o-transform .3s ease-out;
//     transition:         transform .3s ease-out;
//     -webkit-transform: translate3d(100%, 0, 0);
//     transform: translate3d(100%, 0, 0);
// }

// .modal.in .modal-dialog {
//     -webkit-transform: translate3d(0, 0, 0);
//     transform: translate3d(0, 0, 0);
// }
// CSS;
$js = <<< JS
$(".detailsproduct").on("click", function(e) {
    e.preventDefault();
    url = $(this).attr('href');
    $('#detailProduct')
        .modal('show')
        .find('.modal-body')
        .html('Loading ...')
        .load(url);
        return false;
});
JS;

$this->registerJs($js);

Modal::begin([
    'id' => 'detailProduct',
    'size' => Modal::SIZE_SMALL,
    'title' => 'Detail Product',
    'closeButton' => [
        'id'=>'close-button',
        'class'=>'close',
        'data-dismiss' =>'modal',
    ],
    'clientOptions' => [
        'backdrop' => true, 'keyboard' => true
    ]
]);

Modal::end();