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
			<h4><b><u>SURAT KETERANGAN</u></b></h4>
			<b>No. <?= @$model->no_letter ?>/HCS/PT.ABI/<?= @$model->no_month ?>/<?= @$model->year ?></b><br>
			<!-- <p>Jl. RC. Veteran Raya No.66, RT.4/RW.10, Bintaro, Kec. Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12330</p> -->
		</td>
	</tr>
</table>
&nbsp;
<p>Yang bertanda tangan di bawah ini :</p>
<table align="center">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><?= $user['name'] ?></td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td><?= $user['name'] ?></td>
    </tr>
    <tr>
        <td>Perusahaan</td>
        <td>:</td>
        <td><?= 'Bhadranaya Group Indonesia' ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?= 'Jl. RC. Veteran Raya No.66, RT.4/RW.10, Bintaro, Kec. Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12330' ?></td>
    </tr>
</table>

&nbsp;
<p>Dengan ini menerangkan :</p>
<table align="center">
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><?= $employees['name'] ?></td>
    </tr>
    <tr>
        <td>Nik</td>
        <td>:</td>
        <td><?= $employees['nik'] ?></td>
    </tr>
    <tr>
        <td>Jabatan</td>
        <td>:</td>
        <td><?= $employees['department'] ?></td>
    </tr>
</table>
<!-- KOP SURAT -->
&nbsp;
<!-- ISI -->
	<p style="text-align: justify;">Bahwa yang bersangkutan adalah benar karyawan PT. Ahara Bhadranaya Indonesia sejak <?= $employees['date_join']?> sampai <?= $employees['date_resign']?>. </p>
	<br>
    <p style="text-align: justify;">Demikian Surat Keterangan ini dibuat untuk dipergunakan untuk pencairan BPJS Ketenagakerjaan.</p>
	<!-- ISI -->
    
	<!-- SIGNATURE -->
    &nbsp;
    &nbsp;
    &nbsp;
    &nbsp;
    <p style="text-align: left;">Jakarta, <?= @$model->created_at ?></p>
	<br>
	<br>
	<table align="center" width="100%">
	<tr>
		<td style="text-align: left;">Hormat Kami :</td>
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
		<td style="text-align: left;"><b><u><?= $user['name'] ?></u></b></td>
	</tr>
	<!-- SIGNATURE -->
</table>
</body>

<?php
$css = <<< CSS
CSS;
$this->registerCss($css);
