<?php

use backend\models\MrInParent;
use backend\models\MrInType;
use backend\models\MrInUnit;
use backend\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

$select_unit = ArrayHelper::map(MrInUnit::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
$select_type = ArrayHelper::map(MrInType::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
$select_parent = ArrayHelper::map(MrInParent::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
// $select_user = ArrayHelper::map(User::find()->asArray()->all(), 'id', function($model, $defaultValue){
//     return $model['name'];
// }
// );
/* @var $this yii\web\View */
/* @var $model backend\models\TbInventory */

$this->title = $model->sku;
$this->params['breadcrumbs'][] = ['label' => 'Inventori Bahan Baku', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
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
            <div class="tb-inventory-view">
                <p>
                    <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
                    <!-- <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
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
                        'sku',
                        'desc',
                        
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_in_parent',
                            'filter' => $select_parent,
                            'value' => function ($data) {
                                $parent = MrInParent::findOne($data['id_in_parent']);
                                return $parent['name'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_in_unit',
                            'filter' => $select_unit,
                            'value' => function ($data) {
                                $unit = MrInUnit::findOne($data['id_in_unit']);
                                return $unit['name'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_in_type',
                            'filter' => $select_type,
                            'value' => function ($data) {
                                $type = MrInType::findOne($data['id_in_type']);
                                return $type['name'];
                            },
                        ],
                        // [
                        //     'format' => 'raw',
                        //     'headerOptions' => ['style' => 'text-align:center'],
                        //     'contentOptions' => ['style' =>'text-align:center;'],
                        //     'attribute' => 'id_user',
                        //     'filter' => $select_user,
                        //     'value' => function ($data) {
                        //         $user = User::findOne($data['id_user']);
                        //         return $user['name'];
                        //     },
                        // ],
                        // 'id_in_parent',
                        // 'id_in_type',
                        // 'id_in_unit',
                        // 'id_user',
                        // 'code_satuan',
                        // 'code_in',
                        // 'code_out',
                        // 'code_log',
                        // 'code_waste',
                        // 'status',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>
