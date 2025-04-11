<?php

use backend\models\MrCompany;
use backend\models\MrEmpLetter;
use backend\models\MrTkp;
use backend\models\TbEmployee;
use backend\models\User;
use yii\helpers\Url;

$employees = TbEmployee::findOne(['id' => $model->id_employee]);
$user = User::findOne(['id' => $model->id_user]);
$letter = MrEmpLetter::findOne(['id' => $model->id_letter]);
$company_old = MrCompany::findOne(['id' => $model->sm_old_company]);
$company_new = MrCompany::findOne(['id' => $model->sm_new_company]);
$tkp_old = MrTkp::findOne(['id' => $model->sm_old_tkp]);
$tkp_new = MrTkp::findOne(['id' => $model->sm_new_tkp]);
?>
<body>
<br>
<br>
<!-- KOP SURAT -->
<table align="center">
     <tr>
        <!-- <td width="25" align="left"><img src="<?=Url::base()?>/dist/img/holy_logo.png" width="15%" height="20%"></td> -->
        <td align="center" style="font-family: Georgia;">
            <h4><b>SURAT KEPUTUSAN</b></h4>
            <b>No. <?= @$model->no_letter ?>/SK. Mutasi/HCS/FH/<?= @$model->no_month ?>/<?= @$model->year ?></b><br>
            <br>
            <h5><b>TENTANG</b></h5>
            <h5><b>MUTASI KARYAWAN</b></h5>
        </td>
    </tr>
</table>
<!-- <hr size="100px"> -->
<br>
<p style="margin-bottom: 1"><b>Menimbang : </b></p>
<p style="text-align: justify; padding-left: 15px; margin-bottom: 1">1. Penambahan struktur organisasi tahap awal dan memenuhi kebutuhan organisasi Perusahaan.</p>
<p style="text-align: justify; padding-left: 15px;">2. Bahwa untuk keperluan itu perlu dibuatkan suatu Surat Keputusan.</p>
<!-- <br> -->
<?php echo "\n"; ?>
<p style="margin-bottom: 1"><b>Mengingat : </b></p>
<p style="text-align: justify;">Hasil evaluasi dan rekomendasi yang dilakukan dalam proses pembenahan struktur organisasi Perusahaan.</p>
<br>
<!-- KOP SURAT -->

<!-- ISI -->
<h5 style="text-align: center"><b>Memutuskan : </b></h5>
<h5 style="text-align: left"><b>Menetapkan :</b></h5>
<?php echo "\n"; ?>
<p style="margin-bottom: 2;">Pertama : Menetapkan <b>Mutasi</b> kepada Karyawan di bawah ini</p>
    <table class="table-pdf" align="center" width="100%">
        <tr>
            <th>Nama</th>
            <td><?= $employees['name']?></td>
        </tr>
        <tr>
            <th>Nik</th>
            <td><?= $employees['nik']?></td>
        </tr>
        <tr>
            <th rowspan="1">Posisi Lama</th>
            <td><?= $employees['department']?></td>
        </tr>
        <tr>
            <th>Posisi Baru</th>
            <td><?= $model->sm_new_position?></td>
        </tr>
        <tr>
            <th rowspan="1">Atasan Lama</th>
            <td><?= $model->sm_old_boss?></td>
        </tr>
        <tr>
            <th>Atasan Baru</th>
            <td><?= $model->sm_new_boss?></td>
        </tr>
        <tr>
            <th rowspan="1">Divisi Lama</th>
            <td><?= $model->sm_old_division?></td>
        </tr>
        <tr>
            <th>Divisi Baru</th>
            <td><?= $model->sm_new_division?></td>
        </tr>
        <tr>
            <th rowspan="1">Perusahaan Lama</th>
            <td><?= $company_old['name']?></td>
        </tr>
        <tr>
            <th>Perusahaan Baru</th>
            <td><?= $company_new['name']?></td>
        </tr>
        <tr>
            <th rowspan="1">Lokasi Kerja Lama</th>
            <td><?= $tkp_old['name']?></td>
        </tr>
        <tr>
            <th>Lokasi Kerja Baru</th>
            <td><?= $tkp_new['name']?></td>
        </tr>
    </table>
    <table cellpadding="1" cellspacing="1" style="margin-top: 2;">
        <tr>
			<td>Kedua</td>
			<td>:</td>
			<td>Uraian tugas dan tanggung jawab akan diatur kemudian.</td>
		</tr>
		<tr>
			<td>Ketiga</td>
			<td>:</td>
			<td>Pengaturan masa transisi peralihan tugas dan wewenang diatur tersendiri dalam pelaksanaannya.</td>
		</tr>
		<tr>
			<td>Keempat</td>
			<td>:</td>
			<td>Surat Keputusan ini berlaku efektif sejak tanggal...</td>
		</tr>
    </table>
    &nbsp;
    <p style="text-align: justify;">Sesuai dengan Posisi dan Grade pemegang jabatan yang telah ditetapkan dalam Surat Keputusan ini, maka segala hak dan kewajiban termasuk Compensation & Benefit berlaku sesuai dengan Surat Keputusan Direksi yang diatur tersendiri.</p>
    &nbsp;
    <p style="text-align: justify;">Surat keputusan ini bisa ditinjau kembali sewaktu-waktu apabila diperlukan melalui pertimbangan dan mekanisme  yang berlaku.</p>
    &nbsp;
    <p>Ditetapkan di 	: Jakarta <br>Pada tanggal 	: <?= $model->created_at?></p>
    <!-- ISI -->
    
    <!-- SIGNATURE -->
	<table align="center" width="100%">
    <tr>
        <td style="text-align: left;">Dibuat Oleh :</td>
        <td></td>
        <td style="text-align: center;">Disetujui Oleh : </td>
		<td></td>
        <td style="text-align: right;">Disetujui Oleh : </td>
    </tr>
    <tr>
        <td style="text-align: left;"></td>
        <td style="text-align: center;"></td>
        <td style="text-align: right;"></td>
    </tr>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <br>
    <!-- <tr>
    <td style="text-align: center;"><b><u>Dini Yuli Triyani</u></b></td>
    </tr> -->
    <tr>
        <td style="text-align: left;"><b><?= $user['name'] ?></b></td>
        <td></td>
        <td style="text-align: center;"><b>Head of Services Manager</b></td>
        <td></td>
        <td style="text-align: right;"><b>Head of F&B Manager</b></td>
    </tr>
    </table>
	<!-- SIGNATURE -->
</body>

<?php
$css = <<< CSS
CSS;
$this->registerCss($css);
