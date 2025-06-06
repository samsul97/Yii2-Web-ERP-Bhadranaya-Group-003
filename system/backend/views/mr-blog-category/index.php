<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MrBlogCategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Kategori Artikel';
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
            <div class="mr-blog-category-index">
                <p>
                    <?= Html::a('Tambah Kategori', ['create'], ['class' => 'btn btn-success']) ?>
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
                            // 'status',
                            [
                                'attribute' => 'status',
                                'format' => 'raw',
                                'value' => function ($model) {
                                    if ($model->status == 10) {
                                        return "Aktif";
                                    }
                                    return "Tidak Aktif";
                                }
                            ],
                            'timestamp',
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