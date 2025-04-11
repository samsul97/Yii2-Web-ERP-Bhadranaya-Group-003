<?php

use backend\models\MrTkp;
use backend\models\TbAssets;
use backend\models\User;
use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use kartik\export\ExportMenu;

$select_user = ArrayHelper::map(User::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
$select_assets = ArrayHelper::map(TbAssets::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
$select_tkp = ArrayHelper::map(MrTkp::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $searchModel backend\models\TbAssetsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Jejak Perpindahan Barang';
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
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <div class="tb-assets-move-index">
                <p>
                    <?= Html::a('Tambah Perpindahan Barang', ['create-move'], ['class' => 'btn btn-success']) ?>
                </p>
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <div class="table-responsive table-nowrap">
                    <?php 
                    $gridColumns = [
                        [
                            'class' => 'yii\grid\SerialColumn',
                            'header' => 'No',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' => 'text-align:center']
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_tb_assets',
                            'filter' => $select_assets,
                            'value' => function ($data) {
                                $assets = TbAssets::findOne($data['id_tb_assets']);
                                return $assets['name']. '-' . $assets['sku'];
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
                            'attribute' => 'id_tkp_origin',
                            'filter' => $select_tkp,
                            'value' => function ($data) {
                                $assets = MrTkp::findOne($data['id_tkp_origin']);
                                return $assets['name'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_tkp',
                            'filter' => $select_tkp,
                            'value' => function ($data) {
                                $assets = MrTkp::findOne($data['id_tkp']);
                                return $assets['name'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' => 'text-align:center'],
                            'attribute' => 'qty_move',
                        ],
                        'dom',
                    ];
                    echo ExportMenu::widget([
                        'filterModel' => $searchModel,
                        'columns' => $gridColumns,
                        'dataProvider' => $dataProvider,
                        'filename' => 'Barang Pindah',
                        'batchSize' => 1024,
                    ]);

                    echo GridView::widget([
                        'dataProvider' => $dataProvider,
                        'filterModel' => $searchModel,
                        'columns' => $gridColumns,
                    ]);
                    ?>
                </div>
            </div>
        </div>
    </div>
</div>