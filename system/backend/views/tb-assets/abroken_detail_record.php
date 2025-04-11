<?php
use yii\helpers\Html;

$this->registerCssFile('@web/dist/css/dataTables.bootstrap4.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/dataTables.bootstrap4.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->title = 'Record Barang Kerusakan';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card table-card">
    <div class="card-header">
    <h3 class="card-title"><?php echo 'Jejak Kerusakan Barang ' . '<b>'. $model->name . '-' . $model->sku .'</b>' ?></h3>
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
                        <table class="table table-bordered table-nowrap table-broken-record">
                            <thead>
                                <tr>
                                    <th width="10">No</th>
                                    <th>Barang</th>
                                    <th>Deskripsi</th>
                                    <th>Tanggal Kerusakan</th>
                                    <th>Jumlah Kerusakan</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($model->detailRecordBroken() as $broken): ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= Html::a($model->name . '-' . $model->sku); ?></td>
                                    <td><?= Html::a($broken->condition_issue) ?></td>
                                    <td><?= Html::a($broken->dob); ?></td>
                                    <td><?= Html::a($broken->qty_broken); ?></td>
                                    <td><?= Html::a($broken->status ? $broken->status : 'Belum Diset',); ?></td>
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

var t = $('.table-broken-record').DataTable({
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