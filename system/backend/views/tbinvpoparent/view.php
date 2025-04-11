<?php

use backend\models\MrTkp;
use backend\models\User;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Tbinvpoparent */

$this->title = 'PO INDUK';
$titleAnak = 'PO ANAK';
$this->params['breadcrumbs'][] = ['label' => 'PO Induk', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCssFile('@web/dist/css/dataTables.bootstrap4.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/dataTables.bootstrap4.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$select_user = ArrayHelper::map(User::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
$select_tkp = ArrayHelper::map(MrTkp::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
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
            <div class="tbinvpoparent-view">
                <p>
                    <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'template' => '<tr><th width="180px" style="text-align:right">{label}</th><td>{value}</td></tr>',
                    'attributes' => [
                        [
                            'format' => 'raw',
                            'attribute' => 'purchase_number_parent',
                            'value' => function($model) {
                                return '<b>' . $model->purchase_number_parent . '</b>';
                            }
                        ],
                        'no_transaction',
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
                        'timestamp',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div class="card table-card">
    <div class="card-header">
    <h3 class="card-title"><?= Html::encode($titleAnak) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <div class="tbinvpochild-view">
                <div class="table-responsive table-nowrap">
                    <table class="table table-bordered table-nowrap table-poanak">
                        <thead>
                            <tr>
                                <th width="10">No</th>
                                <th>PO Anak</th>
                                <th>OUTLET</th>
                                <th>Tanggal Order</th>
                                <th>Cetak Surat Jalan</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php $no=1; foreach ($model->detailPoAnak() as $poanak): ?>
                            <?php $tkp = MrTkp::find()->where(['id' => $poanak['id_tkp']])->one();?>
                            <tr>
                                <td><?= $no; ?></td>
                                <td><?= $poanak->purchase_number_child; ?></td>
                                <td><?= $tkp['name']; ?></td>
                                <td><?= $poanak->timestamp; ?></td>
                                <td><?= Html::a('<i class="fa fa-print"></i>', ['travel-document', 'id' => $model->id], ['class' => 'btn btn-secondary']); ?></td>
                            </tr>
                        <?php $no++; endforeach ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
$js = <<< JS
var t = $('.table-poanak').DataTable({
    "order": [[ 3, "desc" ]],
    "columnDefs": [
        { "orderable": false, "targets": 0 }
      ]
});
JS;

// $this->registerCss($css);
$this->registerJs($js);
?>