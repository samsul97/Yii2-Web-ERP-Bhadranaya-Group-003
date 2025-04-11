<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\MrTkp */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'TKP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);

$this->registerCssFile('@web/dist/css/dataTables.bootstrap4.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/dataTables.bootstrap4.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
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
            <div class="mr-tkp-view">
                <p>
                    <?= Html::a('Create', ['create'], ['class' => 'btn btn-success']) ?>
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
                    'template' => '<tr><th width="180px" style="text-align:right">{label}</th><td>{value}</td></tr>',
                    'attributes' => [
                        'id_company',
                        'code_location',
                        'name',
                        'code',
                        'alamat:ntext',
                        'responbilities',
                        'no_hp',
                        'telp',
                        'ip_viewer',
                        'ip_pos1',
                        'ip_pos2',
                        'ip_pos3',
                        'ip_kitchen',
                        'ip_bar',
                        'ip_public',
                        'ip_office',
                        'ip_mikrotik',
                        'pass_mikrotik',
                        'user_mikrotik',
                        'id_cctv',
                        'id_wifi',
                        'status',
                        'created_at',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div class="card table-card">
    <div class="card-header">
    <h3 class="card-title">Detail WIFI</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
			<div class="mr-wifi-view">
                <!-- <div class="row"> -->
                    <div class="table-responsive table-nowrap">
                        <table class="table table-bordered table-nowrap table-wifi">
                            <thead>
                                <tr>
                                    <th width="10">No</th>
                                    <th>Name</th>
                                    <th>URL</th>
                                    <th>Vendor</th>
                                    <th>SSID</th>
                                    <th>Username Modem</th>
                                    <th>Password Modem</th>
                                    <th>Username Login</th>
                                    <th>Password Login</th>
                                    <th>Speed</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($model->detailWifi() as $wifi): ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= Html::a($wifi->name, ['mr-wifi/view', 'id' => $wifi->id]); ?></td>
                                    <td><?= Html::a($wifi->url); ?></td>
                                    <td><?= Html::a($wifi->vendor); ?></td>
                                    <td><?= Html::a($wifi->ssid); ?></td>
                                    <td><?= Html::a($wifi->username_modem); ?></td>
                                    <td><?= Html::a($wifi->pasword_modem); ?></td>
                                    <td><?= Html::a($wifi->username_login); ?></td>
                                    <td><?= Html::a($wifi->password_login); ?></td>
                                    <td><?= Html::a($wifi->speed); ?></td>
                                </tr>
                            <?php $no++; endforeach ?>
                        </tbody>
                        </table>
                    </div>
                <!-- </div> -->
			</div>
		</div>
	</div>
</div>

<div class="card table-card">
    <div class="card-header">
    <h3 class="card-title">Detail CCTV</h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
			<div class="mr-cctv-view">
                <!-- <div class="row"> -->
                    <div class="table-responsive table-nowrap">
                        <table class="table table-bordered table-nowrap table-cctv">
                            <thead>
                                <tr>
                                    <th width="10">No</th>
                                    <th>Name</th>
                                    <th>Vendor</th>
                                    <th>IP</th>
                                    <th>Port</th>
                                    <th>Username</th>
                                    <th>Password</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($model->detailCctv() as $cctv): ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= Html::a($cctv->name, ['mr-cctv/view', 'id' => $cctv->id]); ?></td>
                                    <td><?= Html::a($cctv->vendor); ?></td>
                                    <td><?= Html::a($cctv->ip); ?></td>
                                    <td><?= Html::a($cctv->port); ?></td>
                                    <td><?= Html::a($cctv->username); ?></td>
                                    <td><?= Html::a($cctv->password); ?></td>
                                </tr>
                            <?php $no++; endforeach ?>
                        </tbody>
                        </table>
                    </div>
                <!-- </div> -->
			</div>
		</div>
	</div>
</div>

<?php

$js = <<< JS

var t = $('.table-wifi').DataTable({
    "order": [[ 3, "desc" ]],
    "columnDefs": [
        { "orderable": false, "targets": 0 }
      ]
});

var t = $('.table-cctv').DataTable({
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
