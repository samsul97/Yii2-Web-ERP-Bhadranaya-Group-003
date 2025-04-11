<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap4\Modal;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbOpsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Operasional Master Data';
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
            <div class="tb-ops-index">
                <p>
                    <?= Html::a('Tambah Data', ['create'], ['class' => 'btn btn-success']) ?>
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
                            //'timestamp',
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Action',
                                'template' => '{view} {update} {delete}',
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
                                    'delete' => function($url, $model) {
                                        return Html::a('<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>', 
                                            ['delete', 'id' => $model['id']], 
                                            ['title' => 'Delete', 'class' => '', 'data' => 
                                            ['confirm' => 'Apakah anda ingin menghapus data ?', 'method' => 'post', 'pjax' => 1],
                                        ]);
                                    }
                                ]
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="card table-card">
    <div class="card-header">
        <h3 class="card-title">FTP server</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <div class="tb-ops-eod">
                <?= Html::a('EOD', ['eod'], ['class' => 'btn btn-success']) ?>
                <?= Html::a('Sales Mix', ['eod'], ['class' => 'btn btn-info']) ?>
                <?= Html::a('Summary', ['eod'], ['class' => 'btn btn-danger']) ?>
                <?= Html::a('Grafik', ['eod'], ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
    </div>
</div>

<?php
// $url = Url::base().'/tb-ops/detail';
// $js = <<< JS
// $(".eod").on("click", function(e) {
//     alert($url);
//     e.preventDefault();
//     url = '$url';
//     $('#eodOpen')
//         .modal('show')
//         .find('.modal-body')
//         .html('Loading ...')
//         .load(url);
//         return false;
// });
// JS;

// Modal::begin([
//     'id' => 'eodOpen',
//     'size' => Modal::SIZE_LARGE,
//     'title' => 'FTP Server',
//     'closeButton' => [
//         'id'=>'close-button',
//         'class'=>'close',
//         'data-dismiss' =>'modal',
//     ],
//     // keeps from closing modal with esc key or by clicking out of the modal.
//     // user must click cancel or X to close
//     'clientOptions' => [
//         'backdrop' => false, 'keyboard' => true
//     ]
// ]);

// Modal::end();
?>