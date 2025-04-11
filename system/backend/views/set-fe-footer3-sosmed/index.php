<?php

use yii\helpers\Html;
use yii\grid\GridView;
// use yii\helpers\Url;
use yii\bootstrap4\Modal;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SetFeFooter3SosmedSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Set Footer Sosmed';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="set-fe-footer3-sosmed-index">
    <p>
        <?= Html::a('Create Sosmed', ['create'], ['class' => 'btn btn-success sosmedInput']) ?>
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
                'icon',
                'link',
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

<?php
$js = <<< JS
$('.sosmedInput').on('click', function(e) {
    e.preventDefault();
    $('#inputSosmed')
        .modal('show')
        .find('#modalcontentCreate')
        .html('Loading...')
        .load($(this).attr('href'));
        return false;
    }
)
JS;
$this->registerJs($js);

Modal::begin([
    'id' => 'inputSosmed',
    'size' => Modal::SIZE_LARGE,
    'title' => 'Create Sosmed',
    'closeButton' => [
        'id'=>'close-button',
        'class'=>'close',
        'data-dismiss' =>'modal',
    ],
    'clientOptions' => [
        'backdrop' => true, 'keyboard' => true
    ]
]);
echo "<div id='modalcontentCreate'></div>";
Modal::end();
?>