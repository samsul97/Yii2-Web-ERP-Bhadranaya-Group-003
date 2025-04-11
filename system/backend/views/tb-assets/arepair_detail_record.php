<?php
use yii\helpers\Html;
$this->registerCssFile('@web/dist/css/dataTables.bootstrap4.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/dataTables.bootstrap4.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$this->title = 'Record Barang Perbaikan';
$this->params['breadcrumbs'][] = $this->title;

?>
<div class="card table-card">
    <div class="card-header">
    <h3 class="card-title"><?php echo 'Jejak Perbaikan Barang ' . '<b>'. $model->name . '-' . $model->sku .'</b>' ?></h3>
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
                        <table class="table table-bordered table-nowrap table-repair-record">
                            <thead>
                                <tr>
                                    <th width="10">No</th>
                                    <th>Barang</th>
                                    <th>Issue</th>
                                    <th>Status</th>
                                    <th>Jumlah Perbaikan</th>
                                    <th>Tanggal Perbaikan</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($model->detailRecordRepair() as $repair): ?>
                                <tr>
                                    <td><?= $no; ?></td>
                                    <td><?= Html::a($model->name . '-' . $model->sku); ?></td>
                                    <td><?= Html::a($repair->condition_issue); ?></td>
                                    <td><?= Html::a($repair->status); ?></td>
                                    <td><?= Html::a($repair->qty_repair); ?></td>
                                    <td><?= Html::a($repair->dor); ?></td>
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

var t = $('.table-repair-record').DataTable({
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