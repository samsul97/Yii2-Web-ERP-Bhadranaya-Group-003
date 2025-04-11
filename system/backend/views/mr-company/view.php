<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $model backend\models\MrCompany */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Perusahaan', 'url' => ['index']];
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
            <div class="mr-company-view">
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
                        'name',
                        'desc:ntext',
                        'address',
                        'telp',
                        'email:email',
                        'vision_mision',
                        'products:ntext',
                        'domain',
                        'username',
                        'password',
                        'url_cpanel:url',
                        'status',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div class="card table-card">
    <div class="card-header">
    <h3 class="card-title"><?php echo 'Daftar TKP ' . $model->name?></h3>
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
			<div class="mr-wifi-view">
                <!-- <div class="row"> -->
                    <div class="table-responsive table-nowrap">
                        <table class="table table-bordered table-nowrap table-tkp">
                            <thead>
                                <tr>
                                    <th width="10">No</th>
                                    <th>Kode Location</th>
                                    <th>Name</th>
                                    <th>Alamat</th>
                                    <th>Penanggung Jawab</th>
                                    <th>No HP</th>
                                    <th>Telp</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($model->detailTKP() as $tkp): ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= Html::a($tkp->code_location); ?></td>
                                    <td><?= Html::a($tkp->name, ['mr-tkp/view', 'id' => $tkp->id]); ?></td>
                                    <td><?= Html::a($tkp->alamat); ?></td>
                                    <td><?= Html::a($tkp->responbilities); ?></td>
                                    <td><?= Html::a($tkp->no_hp); ?></td>
                                    <td><?= Html::a($tkp->telp); ?></td>
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

var t = $('.table-tkp').DataTable({
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