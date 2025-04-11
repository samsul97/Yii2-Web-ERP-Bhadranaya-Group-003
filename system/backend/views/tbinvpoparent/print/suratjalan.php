<?php
	use yii\helpers\Html;
    use app\components\Helper;
    use yii\helpers\Url;
?>
<body>
<!-- KOP SURAT -->
<table align="center">
	 <tr>
		<td width="25" align="left"><img src="<?=Url::base()?>/dist/img/holy_logo.png" width="15%" height="20%"></td>
		<td align="center" style="font-family: Georgia;">
			<h2 style="font-style: bold;">SURAT PENETAPAN DEMOSI<br>
			BHADRANAYA GROUP<br></h2>
			<h1>(021) 73887469</h1>
			<p>Jl. RC. Veteran Raya No.66, RT.4/RW.10, Bintaro, Kec. Pesanggrahan, Kota Jakarta Selatan, Daerah Khusus Ibukota Jakarta 12330</p>
		</td>
		
	</tr>
</table>
<hr size="100px">

<!-- ISI -->
	<br><br>
	<p align="center"><b><u>SURAT PENETAPAN DEMOSI</u></b></p>
	<br><br>
	<?php { ?>
	
	<p>Saya yang bertanda tangan dibawah ini :</p>
	<table cellpadding="1" cellspacing="1" style="left: 30%;">
		<tr>
			<td>No Surat</td>
			<td>:</td>
			<td> <?= @$model->no_letter ?></td>
		</tr>
		<tr>
			<td style="width:150px;">No Bulan</td>
			<td style="width:0px;">:</td>
			<td> <?= @$model->no_month ?>, <?= @$model->no_month ?></td>
		</tr>
		<tr>
			<td>Tahun</td>
			<td>:</td>
			<td> <?= @$model->year ?></td>
		</tr>
	</table>
	<table>
		<tr>
			<td>Dengan ini menyatakan dengan sebenar-benarnya bahwa saya sebagai HRD memberikan Surat Penetapan Demosi :</td>
		</tr>
	</table>
	<table cellpadding="1" cellspacing="1" style="left: 30%;">
		<tr>
			<td style="width:150px;">Nama</td>
			<td>:</td>
			<td> <?= @$model->id_employee ?></td>
		</tr>
		<tr>
			<td>Nik</td>
			<td>:</td>
			<td> <?= @$model->id_employee ?>, <?= @$model->id_employee ?></td>
		</tr>
		<tr>
			<td>Jabatan</td>
			<td>:</td>
			<td>  <?= @$model->id_employee ?></td>
		</tr>
	</table>
	<br>

	<br>
	<p>Demikian Surat pernyataan ini dibuat agar dapat dipergunakaan sebagai mestinya.</p>
	<br>
	<br>
	<br>
    
    <table align="right" width="100%">
	<tr>
		<td style="text-align: center;">Pembuat SP :</td>
		<td style="text-align: center;">Indramayu, Februari 2019</td>s
	</tr>
	<tr>
		<td style="text-align: center;">HRD</td>
		<td style="text-align: center;"><b>a/n <?= @$model->id_user ?></b></td>
	</tr>
	<tr>
		<td style="text-align: center;"></td>
		<td style="text-align: center;">Human Resources Development</td>
	</tr>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<tr>
		<td style="text-align: center;"><b><u>...................</u></b></td>
		<td style="text-align: center;"><b><u>M U H A D I</u></b></td>
	</tr>
</table>
<br>
<br>
<br>
<table align="center">
	<tr>
		<td style="text-align: center;">KUWU</td>
	</tr>
	<br>
	<br>
	<br>
	<br>
	<br>
	<br>
	<tr>
		<td style="text-align: center;"><b><u>ASMANTO</u></b></td>
	</tr>
	 <?php } ?>
</table>

</body>
