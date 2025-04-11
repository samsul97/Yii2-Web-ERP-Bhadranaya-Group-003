<?php

use backend\models\MrCctv;
use backend\models\MrCompany;
use backend\models\MrWifi;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\MrTkpSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$select_company = ArrayHelper::map(MrCompany::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
$select_cctv = ArrayHelper::map(MrCctv::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
$select_wifi = ArrayHelper::map(MrWifi::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
$this->title = 'TKP';
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
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <div class="mr-tkp-index">
                <p>
                    <?= Html::a('Tambah TKP', ['create'], ['class' => 'btn btn-success']) ?>
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
                            'code_location',
                            'name',
                            // 'code',
                            'alamat:ntext',
                            'responbilities',
                            'no_hp',
                            'telp',
                            //'ip_viewer',
                            //'ip_pos1',
                            //'ip_pos2',
                            //'ip_pos3',
                            //'ip_kitchen',
                            //'ip_bar',
                            //'ip_public',
                            //'ip_office',
                            //'ip_mikrotik',
                            //'pass_mikrotik',
                            //'user_mikrotik',
                            // 'id_cctv',
                            // 'id_wifi',
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center;'],
                                'attribute' => 'id_wifi',
                                'filter' => $select_wifi,
                                'value' => function ($data) {
                                    $wifi = MrWifi::findOne($data['id_wifi']);
                                    return $wifi['name'];
                                },
                            ],
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center;'],
                                'attribute' => 'id_cctv',
                                'filter' => $select_cctv,
                                'value' => function ($data) {
                                    $cctv = MrCctv::findOne($data['id_cctv']);
                                    return $cctv['name'];
                                },
                            ],
                            [
                                'filter' => [ 10 => 'ACTIVE', 9 => 'INACTIVE', 0 => 'DELETED' ],
                                'attribute' => 'status',
                                'value' => function ($data) {
                                    return [ 10 => 'ACTIVE', 9 => 'INACTIVE', 0 => 'DELETED' ][$data['status']];
                                },
                            ],
                            //'status',
                            //'created_at',
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
