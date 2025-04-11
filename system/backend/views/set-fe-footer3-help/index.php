<?php

use backend\models\UserMenu;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$select_usermenu = ArrayHelper::map(UserMenu::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SetFeFooter3HelpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Set Footer Help';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="set-fe-footer3-help-index">
    <p>
        <?= Html::a('Create Help', ['create'], ['class' => 'btn btn-success']) ?>
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
                // 'id_menu',
                [
                    'format' => 'raw',
                    'headerOptions' => ['style' => 'text-align:center'],
                    'contentOptions' => ['style' =>'text-align:center;'],
                    'attribute' => 'id_menu',
                    'filter' => $select_usermenu,
                    'value' => function ($data) {
                        $usermenu = UserMenu::findOne($data['id_menu']);
                        return $usermenu['name'];
                    },
                ],
                // 'timestamp',

                [
                    'class' => 'yii\grid\ActionColumn',
                    'header' => 'Action',
                    'template' => '{update} {delete}',
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
