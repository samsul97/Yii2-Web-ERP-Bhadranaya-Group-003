<?php

use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbMarProgramSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Program Holycow';
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
            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button> -->
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <div class="tb-mar-program-index">
                <p>
                    <?= Html::a('Tambah Program', ['create'], ['class' => 'btn btn-success']) ?>
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
                            'start',
                            'end',
                            // 'description:ntext',
                            // 'is_reward',
                            [
                                'format' => 'raw',
                                'attribute' => 'permalinks',
                                'value' => function($model) {
                                    if ($model->permalinks == null) {
                                        return 'Link tidak ada';
                                    }
                                    return Html::a('Link', $model->permalinks);
                                }
                            ],
                            // 'permalinks',
                            // 'timestamp',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Action',
                                'template' => '{detail}',
                                'buttons' => [
                                    // 'view' => function($url, $model) {
                                    //     return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                                    //         ['view', 'id' => $model['id']], 
                                    //         ['title' => 'View', 'data' => 
                                    //         ['pjax' => 1]
                                    //     ]);
                                    // },
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
                                    // 'detail' => function($model) {
                                    //     return Html::a('<button class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i></button>',
                                    //     ['detail', 'id_detail' => $model['id']],
                                    //     ['title' => 'Detail Info', 'class' => 'detailsProgram', 'data' => ['pjax' => 1]
                                    //     ]);
                                    // }
                                    'detail' => function($url, $model) {
                                        return Html::a('<button class="btn btn-sm btn-info"><i class="fa fa-info-circle"></i></button>', 
                                            ['detail', 'id' => $model['id']], 
                                            ['title' => 'View', 'class' => 'detailsprogram', 'data' => 
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
// id dari button dilempar ke jquery dengan cara attr('href)
$js = <<< JS
$(".detailsprogram").on("click", function(e) {
    e.preventDefault();
    url = $(this).attr('href');
    $('#detailProgram')
        .modal('show')
        .find('.modal-body')
        .html('Loading ...')
        .load(url);
        return false;
});
JS;

$css = <<< CSS
CSS;

$this->registerJs($js);
$this->registerCss($css);

Modal::begin([
    'id' => 'detailProgram',
    'size' => Modal::SIZE_LARGE,
    'title' => 'Detail Program',
    'closeButton' => [
        'id'=>'close-button',
        'class'=>'close',
        'data-dismiss' =>'modal',
    ],
    // keeps from closing modal with esc key or by clicking out of the modal.
    // user must click cancel or X to close
    'clientOptions' => [
        'backdrop' => false, 'keyboard' => true
    ]
]);

Modal::end();