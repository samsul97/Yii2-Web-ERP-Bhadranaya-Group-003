<?php
use yii\helpers\Html;
use app\components\Helper;
use backend\models\MrEmpLetter;
use backend\models\TbEmployee;
use backend\models\User;
use yii\helpers\Url;

$employees = TbEmployee::findOne(['id' => $model->id_employee]);
$user = User::findOne(['id' => $model->id_user]);
$letter = MrEmpLetter::findOne(['id' => $model->id_letter]);
?>
<body>
<br>
<br>
<!-- KOP SURAT -->
<table align="center">
	 <tr>
		<!-- <td width="25" align="left"><img src="<?=Url::base()?>/dist/img/holy_logo.png" width="15%" height="20%"></td> -->
		<td align="center" style="font-family: Georgia;">
			<h4><b><?= $letter['name']; ?></b></h4>
			<br><b>No. <?= @$model->no_letter ?>/PT. ABI-SP/<?= @$model->no_month ?>/<?= @$model->year ?></b><br>
			<!-- <p>Jl. RC. Veteran Raya No.66, RT.4/RW.10, Bintaro, Kec. Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12330</p> -->
		</td>
	</tr>
</table>
<hr size="100px">
<p>Dibuat oleh perusahaan, ditujukan kepada :</p>
<p>NIK : <?= $employees['nik']?></p>
<p>Nama : <?= $employees['name'] ?> </p>
<p>Jabatan : <?= $employees['department']?></p>
<br>
<!-- KOP SURAT -->

<!-- ISI -->
	<p style="text-align: justify;">Sehubungan dengan tindakan indisipliner dan pelanggaran yang Anda lakukan yaitu : </p>
	<p style="text-align: justify;"><?= $model->contents ?></p>
	
	<br>
	<p style="text-align: justify;">Sehubungan dengan hal diatas, maka :</p>

	<p style="text-align: justify;">Saudara <?= $employees['name'] ?><b> telah gagal melakukan fungsi dan tanggung jawabnya sebagai..</b></p>
	<br>
	<p style="text-align: justify;">Maka dengan ini perusahaan memberikan SURAT PERINGATAN KETIGA dengan ketentuan sebagai berikut :</p>
	
	<!-- text-indent: 50px; text-align: justify; -->
	<p style="text-align: justify">1. Surat keterangan ini berlaku untuk 6 (enam) bulan ke depan sejak tanggal dikeluarkan</p>
	<p style="text-align: justify;">2. Apabila dalam masa ini, saudara melakukan pelanggaran apapun itu maka saudara  siap mengajukan pengunduran diri tanpa ada paksaan dari pihak manapun.</p>
	
	<?php { ?>
	<br>
	<p>Demikian <?= $letter['name']; ?> ini dibuat agar dapat diperhatikan dan ditaati dengan baik oleh yang bersangkutan.</p>
	<br>
	<!-- ISI -->
    
	<!-- SIGNATURE -->
    <p style="text-align: left;">Jakarta, <?= @$model->created_at ?></p>
	<br>
	<br>
	<table align="center" width="100%">
	<tr>
		<td style="text-align: center;">Dibuat Oleh :</td>
		<td></td>
		<td style="text-align: center;">Karyawan</td>
	</tr>
	<tr>
		<td style="text-align: center;"></td>
		<td style="text-align: center;"></td>
	</tr>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<tr>
		<td style="text-align: center;"><b><u><?= $user['name'] ?></u></b></td>
		<td></td>
		<td style="text-align: center;"><b><u><?= $employees['name'] ?></u></b></td>
	</tr>
	<!-- SIGNATURE -->
</table>
<?php } ?>
</body>

<?php
$css = <<< CSS
CSS;
$this->registerCss($css);
