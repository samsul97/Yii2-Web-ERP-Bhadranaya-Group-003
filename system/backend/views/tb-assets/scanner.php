<?php

use backend\models\TbAssets;
use backend\models\TbAssetsBroken;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;

$number = Yii::$app->request->get('number');

$this->params['breadcrumbs'][] = ['label' => 'Scan Barcode Aset', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->title = 'Scanner Barcode';
$this->params['breadcrumbs'][] = $this->title;

// call CSS and JS by Zxing Barcode
$this->registerJsFile('@web/dist/js/android.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
// $this->registerJsFile('@web/')
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
			<div class="scanner">
				<!-- =============== Barcode By Zxing Webview =============== -->
				<div class="row">
					<div class="col">
						<h4>Input Nomor Barang <button type="button" class="btn sweet-1 btn-outline-primary" style="padding: 0 8px">?</button></h4>
						<div class="input-group">
							<input id="input" type="text" class="form-control" placeholder="Nomor Barang" aria-label="Recipient's username" aria-describedby="basic-addon2" value="<?=$number?>">
							<div class="input-group-append">
								<button id="enter" class="btn btn-outline-primary btn-icon"><i class="fa fa-check"></i></button>
								<button id="scan" class="btn btn-outline-primary btn-icon"><i class="fa fa-barcode"></i></button>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="isi" style="margin-top:16px;display:<?=!empty($data_trace["shipment"]["sku"])?"block":"none"?>">
				<h2 class="table-header">Data Barang</h2>
				
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>No Barang</th>
								<th>Nama Barang</th>
								<th>Jumlah Saat ini</th>
								<!-- <th>Posisi Terakhir</th> -->
								<th>Aksi</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td><?=$data_trace["shipment"]["sku"]?></td>
								<td><?=$data_trace["shipment"]["name"]?></td>
								<td><?=$data_trace["shipment"]["qty_current"]?></td>
								<!-- <td>Tombol Direct Rusak/Pindah/Perbaiki</td> -->
								
								<?php
								$value = ArrayHelper::getValue($data_trace, 'shipment.id');
								// var_dump($value);
								// die;
								?>
								<td style="display: inline-block; padding: 5px; width:100%;">
								<?= Html::a('<i class="fa fa-recycle fa-sm"></i>', ['create-broken', 'id_tb_assets' => $data_trace["shipment"]["id"]], ['class' => 'btn btn-danger']) ?> &nbsp;
								<?= Html::a('<i class="fa fa-wrench fa-sm"></i>', ['create-repair', 'id_tb_assets' => $data_trace["shipment"]["id"]], ['class' => 'btn btn-info']) ?> &nbsp;
								<?= Html::a('<i class="fa fa-exchange-alt fa-sm"></i>', ['create-move', 'id_tb_assets' => $data_trace["shipment"]["id"]], ['class' => 'btn btn-success']) ?> &nbsp;
								<?= Html::a('<i class="fa fa-search fa-sm"></i>', ['view', 'id' => $data_trace["shipment"]["id"]], ['class' => 'btn btn-success']) ?> &nbsp;
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="kosong" style="display:<?=!empty($data_trace["shipment"]["sku"])?"none":"block"?>">
				<span style="text-align: center; display: block">
					Periksa dan pastikan kembali bahwa nomor yang dimasukan adalah benar
				</span>
			</div>
		</div>
	</div>
</div>

<?php

$urlTrace = Url::to(['tb-assets/scanner']);

$js = <<< JS
// =========== Custom ============
function checkAndroid() {
    if (typeof Android !== "undefined" && Android !== null) {
        return true
    }
    swal.fire("Warning!", "Hanya bisa dijalankan diperangkat Android", "warning");
    return false
}
$('#input').keypress(function(e) {
    if (e.keyCode == 13) {    
        $("#enter").click();
    }
});

$("#enter").click(function(e) {
    input = $('#input').val();
    if (input.match(/^[0-9a-zA-Z\s-]{1,20}$/)) {
        swal.fire({
            title: "Success!",
            text: "Barang " + input + " berhasil dimasukan",
            icon: "success",
            timer: 1000,
        });
		window.location = '$urlTrace' + '?number=' + input;
    } else {
        swal.fire("Error!", "Nomor Barang Salah", "error");
    }
});
if ($('.isi').is(":visible")) {
	swal.fire({
        title: "Success!",
        text: "Barang $number berhasil ditemukan",
        icon: "success",
        timer: 1000,
    });
	if (checkAndroid()) {
		Android.showNotification(1,"BARANG DI TEMUKAN", "$number");
	}
} 

if ($('.isi').is(":hidden")) {
	if ("$number" !== "") {
		swal.fire("Error!", "Data tidak ditemukan", "error");
	}
}

$("#scan").click(function(e) {
    if (checkAndroid()) {
    	$('.isi').hide();
        Android.scanBarcode();
    }
});

$(".sweet-1").click(function(e) {
    swal.fire({
    	// html: true, 
    	title: 'Informasi', 
    	text: 'Silahkan melihat nomor yang tersedia pada Blangko Formulir atau Dokumen yang lainnya'
    });
});
JS;

$css = <<< CSS
.table td, .table th {
	padding: 5px;
}

.table-header {
	background: #4099ff;
	font-size: 13px;
	padding: 6px;
	color: #fff;
}
CSS;

$this->registerCss($css);
$this->registerJs($js);

?>