<?php

use backend\models\MrEmpLetter;
use backend\models\TbEmployee;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

$select_employee = ArrayHelper::map(TbEmployee::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['nie']. ' - ' . $model['name'];
}
);

$select_letter = ArrayHelper::map(MrEmpLetter::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);




/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbEmpAdministrationSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Surat Menyurat';
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
            <div class="tb-emp-administration-index">
                <?php
                $level = Yii::$app->user->identity->level;
                if ($level == 'f4078c01743a307c59b45913b9cce2a8') {
                    echo '';
                } else {
                    echo '<p>';
                    echo Html::a('Tambah Surat', ['create'], ['class' => 'btn btn-success']);
                    echo '</p>';
                }
                ?>
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
                            // 'id_employee',
                            // 'id_letter',
                            // 'id_user',
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center;'],
                                'attribute' => 'id_employee',
                                'filter' => $select_employee,
                                'value' => function ($data) {
                                    $employee = TbEmployee::findOne($data['id_employee']);
                                    return $employee['nie']. '-' . $employee['name'];
                                },
                            ],
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center;'],
                                'attribute' => 'id_letter',
                                'filter' => $select_letter,
                                'value' => function ($data) {
                                    $letter = MrEmpLetter::findOne($data['id_letter']);
                                    return $letter['name'];
                                },
                            ],
                            // 'no_letter',
                            // 'no_month',
                            'year',
                            'created_at',
                            //'timestamp',  
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Opsi',
                                'template' => '{view}',
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
                                    // 'delete' => function($url, $model) {
                                    //     return Html::a('<button class="btn btn-sm btn-danger"><i class="fa fa-trash"></i></button>', 
                                    //         ['delete', 'id' => $model['id']], 
                                    //         ['title' => 'Delete', 'class' => '', 'data' => 
                                    //         ['confirm' => 'Apakah anda ingin menghapus data ?', 'method' => 'post', 'pjax' => 1],
                                    //     ]);
                                    // }
                                ]
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>