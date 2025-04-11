<?php

use backend\models\MrBusinessfields;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $user common\models\User */
$businessfields = MrBusinessfields::findOne($model['id_tb_bf']);
?>
<div class="vendor-email">
    <h3>Dear Holycow,</h3>
    <h4>Berikut adalah surat penawaran dari kami : </h4>
	<hr width="100%">
    <!-- <center> -->
	<p>Tanggal Registrasi : <?= $model->created_at ?></p>
	<p>Perusahaan : <?= $model->name; ?></p>
	<p>Email : <?= $model->email; ?></p>
	<p>Telp : <?= $model->telp; ?></p>
	<p>Tipe Bisnis : <?= $model->type_business; ?></p>
	<p>Bidang Usaha : <?= $businessfields['name']; ?></p>
	<p>Bidang Usaha Lain-lain : <?= $model['tb_bf_etc'] ? $model['tb_bf_etc'] : 'Tidak ada'; ?></p>
	<br>
	<br>

	<p>Email direktur : <?= $model->email_dr; ?></p>
	<p>Telp direktur : <?= $model->telp_dr; ?></p>
	<br>
	<br>

	<p>Nama Sales : <?= $model->name_sl; ?></p>
	<p>Email Sales : <?= $model->email_sl; ?></p>
	<p>Telp Sales : <?= $model->no_sl; ?></p>
	<p>Cara Pembayaran : <?= $model->payment_method; ?></p>

	<p>Terms of Payment : <?= $model->top; ?></p>
	
	<br>
	<p>Download Surat Penawaran disini : <?= Html::a('Download Surat Penawaran', 'https://bhadranayagroup.com' . $model->offering_letter, ['target' => '_blank', 'class' => 'btn btn-info']) ?></p>
	<p>Atas perhatianya kami ucapkan terima kasih.</p>
	<hr width="100%">
	<!-- </center> -->
</div>
