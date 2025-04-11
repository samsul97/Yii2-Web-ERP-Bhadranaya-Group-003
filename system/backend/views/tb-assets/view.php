<?php

use backend\models\MrInCategory;
use backend\models\MrTkp;
use backend\models\User;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use Da\QrCode\QrCode;

/* @var $this yii\web\View */
/* @var $model backend\models\TbAssets */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Aset', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$select_user = ArrayHelper::map(User::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
$select_tkp = ArrayHelper::map(MrTkp::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_category = ArrayHelper::map(MrInCategory::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

// public function actions() {
//     return [
//         'qrcode' => [
//             'class' => QRcodeAction::className(),
//             'enableCache' => true,
//             'allowClientEclevel' => true,
//             'ecLevel' => QRcode::QR_ECLEVEL_H,
//             'defaultSize' => 4,
//             'allowClientSize' => true,
//             'maxSize' => 10,
//             'defaultMargin' => 2,
//             'allowClientMargin' => true,
//             'maxMargin' => 10,
//             'outputDir' => '@webroot/upload/qrcode',
//             'onGetFilename' => function (QRcodeAction $data) {
//                 return sha1($data->text) . '.png';
//             }
//         ]
//     ];
// }

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
            <div class="tb-assets-view">
                <p>
                    <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <!-- <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?> -->
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'template' => '<tr><th width="180px" style="text-align:right">{label}</th><td>{value}</td></tr>',
                    'attributes' => [
                        // 'sku',
                        [
                            'format' => 'raw',
                            'attribute' => 'sku',
                            'value' => function($model) {
                                return '<b>' . $model->sku . '</b>';
                            }
                        ],
                        // 'id_user',
                        [
                            'format' => 'raw',
                            'attribute' => 'image',
                            'value' => function ($data) {
                                $image = $data['image'] && is_file(Yii::getAlias('@webroot') . $data['image']) ? $data['image'] : '../images/no_photo_box.jpg';
                                return Html::img(Url::base().$image, ['height' => '200', 'class'=>'img-responsive']);
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_in_category',
                            'filter' => $select_category,
                            'value' => function ($data) {
                                $category = MrInCategory::findOne($data['id_in_category']);
                                return $category['name'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_user',
                            'filter' => $select_user,
                            'value' => function ($data) {
                                $user = User::findOne($data['id_user']);
                                return $user['name'];
                            },
                        ],
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
                        // 'id_tkp',
                        'name',
                        // 'weight',
                        'brand',
                        // 'price',
                        [
                            'format' => 'raw',
                            'attribute' => 'price',
                            'value' => function($model) {
                                return '<b> Rp.' . number_format($model->price, 2); '</b>';
                            }
                        ],
                        'guarantee',
                        'completeness:ntext',
                        'dop',
                        // 'qty',
                        // 'is_condition',
                        // 'condition_issue',
                        // 'status',
                        // 'qr_code',
                        // [
                        //     'attribute' => 'is_condition',
                        //     'format' => 'raw',
                        //     'value' => function ($model) {
                        //         if ($model->is_condition == 'Good') {
                        //             return '<button class ="btn btn-info btn-sm">' . "Normal" . '</button>';
                        //         }
                        //         if ($model->is_condition == 'Abnormal') {
                        //             return '<button class ="btn btn-warning btn-sm">' . "Tidak Normal" . '</button>';
                        //         }
                        //         if ($model->is_condition == 'Broken') {
                        //             return '<button class ="btn btn-danger btn-sm">' . "Rusak" . '</button>';
                        //         }
                        //     },
                        // ],
                        'timestamp',
                        'floor',
                        'contractor',
                        [
                            'format' => 'raw',
                            'attribute' => 'power',
                            'value' => function($model) {
                                if ($model->power) {
                                    return '<b>'. $model->power . " Watt" .'</b>';
                                }
                                else {
                                    return "(Belum diset)";
                                }
                            }
                        ],
                        [
                            'format' => 'raw',
                            'attribute' => 'other_information',
                            'value' => function($model) {
                                if ($model->other_information) {
                                    return $model->other_information;
                                }
                                else {
                                    return "(Belum diset)";
                                }
                            }
                        ],
                        // 'other_information',
                        // 'onGetFilename' => function (QRcodeAction $data) {
                        //     return sha1($data->sku) . '.png';
                        // }
                        // [
                        //     'format' => 'raw',
                        //     'value' => function ($model) {
                        //         $qrCode = (new QrCode($model->sku))
                        //         ->setSize(250)
                        //         ->setMargin(5)
                        //         ->useForegroundColor(51, 153, 255);
                        //         $file = Yii::$app->params['upload'] . 'assets/' . $model->sku . '.png';
                        //         $qrCode->writeFile(Yii::getAlias('@webroot') . $file);
                        //         $image = $qrCode->writeDataUri();
                        //         return Html::img(Url::base().$image, ['height' => '200']);
                        //     },
                        // ],
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>