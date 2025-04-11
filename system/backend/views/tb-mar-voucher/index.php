<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbMarVoucherSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'E-Voucher';
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
            <div class="tb-mar-voucher">
                <!-- <p>
                    <?= Html::a('Tambah Voucher', ['create'], ['class' => 'btn btn-success']) ?>
                </p> -->
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <div class="table-responsive table-nowrap">
                    <?= GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        // 'columns' => $gridColumns,
                        'columns' => [
                            // [
                            //     'class' => 'yii\grid\SerialColumn',
                            //     'header' => 'No',
                            //     'headerOptions' => ['style' => 'text-align:center'],
                            //     'contentOptions' => ['style' => 'text-align:center']
                            // ],
                            [
                                'format' => 'raw',
                                'attribute' => 'code',
                                'value' => function ($model) {
                                    if(Yii::$app->request->get('TbMarVoucherSearch')['code']){
                                        return $model->code;
                                    } else {
                                        return 'Hidden';
                                    }
                                    //return '<div style="display:none" class="hiddenVoucher">'. $model->code. '</div>';
                                }
                            ],
                            // 'code',
                            'name',
                            'value',
                            // 'max_value',
                            [
                                'format' => 'raw',
                                'attribute' => 'status',
                                'value' => function ($model) {
                                    if ($model->status == 1) {
                                        return Html::a('<button class ="btn btn-'. ($model->status == 1 ? 'danger' : 'secondary') .'"> '. ($model->status == 1 ? '' : 'Sudah di ') .'Redeem </button>', ['tb-mar-voucher/edit-status', 'id' => $model->id, 'status' => ($model->status == 1 ? 2 : 1)], ['data' => ['confirm' => ($model->status == 1 ? 'Apa Anda yakin mengklaim voucher ini?' : false)],]);
                                        // return Html::a('<button class = "btn btn danger">'. ['tb-mar-voucher/edit-status', 'id' => $model->id], ['data' => ['confirm' => ($model->status == 1 ? 'Apa Anda yakin mengklaim voucher ini?' : false)]]. '</button>');
                                    }else {
                                        return '<button class="btn btn-secondary disable">'. "Redeem" .'</button>';
                                    }
                                    //return Html::a('<button class ="btn btn-'. ($model->status == 1 ? 'danger' : 'secondary') .'"> '. ($model->status == 1 ? '' : 'Sudah di ') .'Klaim </button>', ['tb-mar-voucher/edit-status', 'id' => $model->id, 'status' => ($model->status == 1 ? 2 : 1)], ['data' => ['confirm' => ($model->status == 1 ? 'Apa Anda yakin mengklaim voucher ini?' : false)],]);
                                },
                                'filter' => [
                                    '1' => 'Belum di Klaim',
                                    '2' => 'Sudah di Klaim',
                                ]
                            ]
                            //'expired_date',
                            //'status',
                            //'created_at',
                            // [
                            //     'class' => 'yii\grid\ActionColumn',
                            //     'header' => 'Action',
                            //     'template' => '{view} {update} {delete}',
                            //     'buttons' => [
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
                            //     ]
                            // ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>