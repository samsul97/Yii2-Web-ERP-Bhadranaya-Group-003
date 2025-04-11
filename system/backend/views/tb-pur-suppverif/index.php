<?php

use backend\models\MrBusinessfields;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbPurSuppverifSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$select_tb_bf = ArrayHelper::map(MrBusinessfields::find()->asArray()->all(), 'id', function($model, $defaultValue) {
    return $model['name'];
}
);


$this->title = 'List Vendor';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-pur-suppverif-index">

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

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
            <div class="tb-mar-banners-index">
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
                            'type_business',
                            [
                                'format' => 'raw',
                                'headerOptions' => ['style' => 'text-align:center'],
                                'contentOptions' => ['style' =>'text-align:center;'],
                                'attribute' => 'id_tb_bf',
                                'filter' => $select_tb_bf,
                                'value' => function ($data) {
                                    $bf = MrBusinessfields::findOne($data['id_tb_bf']);
                                    return $bf['name'];
                                },
                            ],
                            'no_vendor',
                            // 'residence_address:ntext',
                            //'letter_address:ntext',
                            // 'telp',
                            //'facsimile',
                            // 'email:email',
                            //'id_tb_bf',
                            //'id_bank',
                            //'account_number',
                            //'swift_code',
                            //'payment_method',
                            //'offering_letter',
                            //'created_at',
                            // 'img_npwp',
                            // [
                            //     'format' => 'raw',
                            //     'attribute' => 'img_npwp',
                            //     'value' => function ($data) {
                                    
                            //         $test = Yii::$app->urlManagerFrontend->createUrl('bhadranaya');
                            //         $image1 = $test ? $test : '../images/no_photo.jpg';
                            //         return Html::img($image1 . $data['img_npwp'], ['height' => '150', 'width' => '300']);
                            //     },
                            // ],
                            // [
                            //     'format' => 'raw',
                            //     'attribute' => 'img_nib',
                            //     'value' => function ($data) {
                            //         $test = Yii::$app->urlManagerFrontend->createUrl('bhadranaya');
                            //         $image2 = $test ? $test : '../images/no_photo.jpg';
                            //         return Html::img($image2 . $data['img_nib'], ['height' => '150', 'width' => '300']);
                            //     },
                            // ],
                            // [
                            //     'format' => 'raw',
                            //     'attribute' => 'img_directur',
                            //     'value' => function ($data) {
                            //         $test = Yii::$app->urlManagerFrontend->createUrl('bhadranaya');
                            //         $image3 = $test ? $test : '../images/no_photo.jpg';
                            //         return Html::img($image3 . $data['img_directur'], ['height' => '150', 'width' => '300']);
                            //     },
                            // ],
                            [
                                'class' => 'yii\grid\ActionColumn',
                                'header' => 'Opsi',
                                'template' => '{view}',
                                'buttons' => [
                                    'view' => function($url, $model) {
                                        $level = Yii::$app->user->identity->level;
                                        if ($level == '65fe55e3801a7036f00d6e15acc72475') {
                                            return Html::a('<button class="btn btn-sm btn-primary"><i class="fa fa-search"></i></button>', 
                                            ['view', 'id' => $model['id']], 
                                            ['title' => 'View', 'data' => 
                                            ['pjax' => 1]
                                        ]);
                                        }
                                        else {
                                            return '-';
                                        }
                                    },
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
                                ]
                            ],
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
