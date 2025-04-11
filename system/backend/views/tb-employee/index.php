<?php

use backend\models\MrTkp;

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use backend\models\TbEmployee;
use yii\helpers\Url;
use kartik\export\ExportMenu;

$select_tkp = ArrayHelper::map(MrTkp::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbEmployeeSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Data Karyawan';
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
            <div class="tb-employee-index">
                <p>
                    <?= Html::a('Tambah Karyawan', ['create'], ['class' => 'btn btn-success']) ?>
                </p>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <div class="table-responsive table-nowrap">
                <?php 
                    $gridColumns = [
                        // [
                        //     'class' => 'yii\grid\SerialColumn',
                        //     'header' => 'No',
                        //     'headerOptions' => ['style' => 'text-align:center'],
                        //     'contentOptions' => ['style' => 'text-align:center']
                        // ],
                        // ['class' => 'yii\grid\CheckboxColumn'],
                        'nie',
                        // 'nie_old',
                        // 'nik',
                        // 'name',
                        [
                            'format' => 'raw',
                            'attribute' => 'name',
                            'value' => function($model) {
                                if ($model->status == 'Resign') {
                                    return Html::a($model->name, ['view', 'id' => $model->id], ['style' => 'color: #eb3b5a']);
                                }
                                else{
                                    return Html::a($model->name, ['view', 'id' => $model->id]);
                                }
                            }
                        ],
                        // [
                        //     'format' =>'raw',
                        //     'attribute' => 'status',
                        //     'value' => function($url, $model, $key, $index) {
                        //         if ($status == $model) {
                        //             return Html::a(['class' => 'danger']);
                        //         }
                        //     }
                        // ],
                        // 'id_tkp',
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_tkp',
                            'filter' => $select_tkp,
                            'value' => function ($data) {
                                $tkp = MrTkp::findOne($data['id_tkp']);
                                return $tkp['name'];
                            },
                        ],
                        // 'status',
                        [
                            'attribute' => 'status',
                            'filter' => ['Contract' => 'Kontrak', 'Permanent' => 'Tetap', 'Resign' => 'Berhenti', 'Probation' => 'Percobaan', 'Blacklist' => 'Blacklist'],
                        ],
                        'date_join',
                        'status_contract',
                        // 'date_resign',
                        // 'department',
                        'position',
                        // 'pob',
                        // 'dob',
                        // [
                        //     'attribute' => 'gender',
                        //     'filter' => ['LAKI' => 'LAKI-LAKI', 'PEREMPUAN' => 'PEREMPUAN'],
                        // ],
                        // 'married_status',
                        // [
                        //     'attribute' => 'married_status',
                        //     'filter' => ['KAWIN' => 'KAWIN', 'BELUM KAWIN' => 'BELUM KAWIN', 'KAWIN ANAK SATU' => 'KAWIN ANAK SATU', 'KAWIN ANAK DUA' => 'KAWIN ANAK DUA', 'KAWIN ANAK TIGA' => 'KAWIN ANAK TIGA'],
                        // ],
                        // [
                        //     'attribute' => 'national',
                        //     'filter' => ['WNI' => 'WNI', 'WNA' => 'WNA'],
                        // ],
                        // 'education',
                        // 'address:ntext',
                        // 'province',
                        // 'city',
                        // 'district',
                        // 'sub_district',
                        // 'postcode',
                        'handphone',
                        // 'email:email',
                        // 'image',
                        // [
                        //     'format' => 'raw',
                        //     'attribute' => 'image',
                        //     'value' => function ($data) {
                        //         $image = $data['image'] && is_file(Yii::getAlias('@webroot') . $data['image']) ? $data['image'] : '../images/no_photo.jpg';
                        //         return Html::img(Url::base().$image, ['height' => '200']);
                        //     },
                        // ],
                        [
                            'class' => 'yii\grid\ActionColumn',
                            'header' => 'Opsi',
                            'template' => '{update}',
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
                            ]
                        ],
                    ];
                    echo ExportMenu::widget([
                        'dataProvider' => $dataProvider,
                        'columns' => $gridColumns,
                        'filename' => 'employee',
                        //'stream' => false,
                        //'linkPath' => false,
                        'batchSize' => 1024,
                    ]);
                ?>
                <?= GridView::widget([
                    'dataProvider' => $dataProvider,
                    'filterModel' => $searchModel,
                    'rowOptions' => function ($model) {
                        if ($model->status == 'Resign') {
                            return ['style' => 'color: #eb3b5a'];
                        }
                    },
                    'columns' => $gridColumns,
                ]); ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php

$js = <<< JS

JS;

$css = <<< CSS

CSS;

$this->registerJs($js);
$this->registerCss($css);