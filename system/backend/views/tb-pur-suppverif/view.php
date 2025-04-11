<?php

use backend\models\MrBank;
use backend\models\MrBusinessfields;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\TbPurSuppverif */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Vendor Registration', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCssFile('@web/dist/css/dataTables.bootstrap4.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/dataTables.bootstrap4.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$select_tb_bf = ArrayHelper::map(MrBusinessfields::find()->asArray()->all(), 'id', function($model, $defaultValue) {
    return $model['name'];
}
);

$select_bank = ArrayHelper::map(MrBank::find()->asArray()->all(), 'id', function($model, $defaultValue) {
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
            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button> -->
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <div class="tb-pur-suppverif-view">
            <p>
                <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?= Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
                <?= DetailView::widget([
                    'model' => $model,
                    'attributes' => [
                        // 'id',

                        /* ==== Perusahaan ==== */
                        'no_vendor',
                        'type_business',
                        // 'img_nib',
                        // 'img_npwp',
                        // 'sk_menkeh',
                        // 'offering_letter',
                        'name',
                        'residence_address:ntext',
                        'letter_address:ntext',
                        'telp',
                        'facsimile',
                        'email:email',
                        [
                            'format' => 'raw',
                            'attribute' => 'id_tb_bf',
                            'filter' => $select_tb_bf,
                            'value' => function ($data) {
                                $business_fields = MrBusinessfields::findOne($data['id_tb_bf']);
                                return $business_fields['name'];
                            },
                        ],
                        'tb_bf_etc',

                        /* ==== Direktur ==== */
                        // 'img_directur',
                        'email_dr',
                        'telp_dr',
                        
                        /* ==== Sales ==== */
                        'name_sl',
                        'no_sl',
                        'email_sl',

                        /* ==== Rekening ==== */
                        [
                            'format' => 'raw',
                            'attribute' => 'id_bank',
                            'filter' => $select_bank,
                            'value' => function ($data) {
                                $bank = MrBank::findOne($data['id_bank']);
                                return $bank['name'];
                            },
                        ],
                        'account_number',
                        'branch_bank',
                        'swift_code',
                        'payment_method',
                        'top',
                        'created_at',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div class="card table-card">
    <div class="card-header">
    <h3 class="card-title"><?php echo 'List Surat Penawaran Lainya '; ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
			<div class="vendor-letter-view">
                <div class="table-responsive table-nowrap">
                    <table class="table table-bordered table-nowrap table-letter">
                        <thead>
                            <tr>
                                <th>No Vendor</th>
                                <th>Surat Penawaran</th>
                                <th>Tanggal Upload</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php foreach ($model->detailLetter() as $letter): ?>
                            <tr>
                                <td><?= $letter->no_vendor?></td>
                                <td><?= $letter->created_at?></td>
                                <td><?= $letter->created_at ?></td>
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                    </table>
                </div>
			</div>
		</div>
	</div>
</div>

<?php
$js = <<< JS
var t = $('.table-letter').DataTable({
    "order": [[ 3, "desc" ]],
    "columnDefs": [
        { "orderable": false, "targets": 0 }
      ]
});

t.on( 'order.dt search.dt', function () {
    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();

JS;

$css = <<< CSS

CSS;

$this->registerCss($css);
$this->registerJs($js);

?>