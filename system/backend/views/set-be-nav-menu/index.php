<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SetBeNavMenuSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Set Be Nav Menus';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="set-be-nav-menu-index">

    <p>
        <?= Html::a('Create Button Menu Navbar', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <div class="table-responsive table-nowrap">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                [
                    'class' => 'yii\grid\SerialColumn',
                    'header' => 'No',
                    'headerOptions' => ['style' => 'text-align:center'],
                    'contentOptions' => ['style' => 'text-align:center']
                ],

                // 'id',
                'name',
                'value',
                'timestamp',

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
