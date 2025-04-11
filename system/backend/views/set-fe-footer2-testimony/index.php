<?php

use yii\bootstrap4\Modal;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;


/* @var $this yii\web\View */
/* @var $searchModel backend\models\SetFeFooter2TestimonySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Set Footer Testimony';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="set-fe-footer2-testimony-index">

    <p>
        <?= Html::a('Create Testimony', ['create'], ['class' => 'btn btn-success testi']) ?>
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
                // 'photo',
                [
                    'format' => 'raw',
                    'attribute' => 'photo',
                    'value' => function ($data) {
                        $image = $data['photo'] && is_file(Yii::getAlias('@webroot') . $data['photo']) ? $data['photo'] : '../images/no_photo.jpg';
                        return Html::img(Url::base().$image, ['height' => '150', 'width' => '300']);
                    },
                ],
                'name',
                'desc:ntext',
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
                                ['title' => 'Update', 'class' => 'updateTesti', 'data' => 
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


<?php
$js = <<< JS
$('.testi').on('click', function(e) {
    e.preventDefault();
    $('#testiMony')
        .modal('show')
        .find('#modalContent')
        .html('Loading...')
        .load($(this).attr('href'));
        return false;
    }
)
$('.updateTesti').on('click', function(e) {
    e.preventDefault();
    $('#testiUpdate')
        .modal('show')
        .find('#modalcontentUpdate')
        .html('Loading...')
        .load($(this).attr('href'));
        return false;
    }
)
JS;

$this->registerJs($js);

Modal::begin([
    'id' => 'testiMony',
    'size' => Modal::SIZE_LARGE,
    'title' => 'Create Testimony',
    'closeButton' => [
        'id'=>'close-button',
        'class'=>'close',
        'data-dismiss' =>'modal',
    ],
    'clientOptions' => [
        'backdrop' => true, 'keyboard' => true
    ]
]);

echo "<div id='modalContent'></div>";

Modal::end();

Modal::begin([
    'id' => 'testiUpdate',
    'size' => Modal::SIZE_LARGE,
    'title' => 'Update Testimony',
    'closeButton' => [
        'id'=>'close-button',
        'class'=>'close',
        'data-dismiss' =>'modal',
    ],
    'clientOptions' => [
        'backdrop' => true, 'keyboard' => true
    ]
]);

echo "<div id='modalcontentUpdate'></div>";

Modal::end();