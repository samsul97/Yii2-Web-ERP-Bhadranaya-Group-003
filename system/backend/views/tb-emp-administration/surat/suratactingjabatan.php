<?php

use backend\models\MrDivision;
use backend\models\MrEmpLetter;
use backend\models\TbEmployee;
use backend\models\User;
use yii\helpers\Url;

$employees = TbEmployee::findOne(['id' => $model->id_employee]);
$user = User::findOne(['id' => $model->id_user]);
$letter = MrEmpLetter::findOne(['id' => $model->id_letter]);
$position = MrDivision::findOne(['id' => $model->act_new_position]);
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
            <b>No. <?= @$model->no_letter ?>/SK. Acting/HCS/PT.ABI/<?= @$model->no_month ?>/<?= @$model->year ?></b><br>
            <br>
            <h5><b>TENTANG</b></h5>
            <h5><b>MASA ACTING KARYAWAN</b></h5>
        </td>
    </tr>
</table>
<!-- <hr size="100px"> -->
<br>
<p style="margin-bottom: 1"><b>Menimbang : </b></p>
<p style="text-align: justify; padding-left: 15px; margin-bottom: 1">1. Pengembangan organisasi yang terjadi di lingkungan Perusahaan.</p>
<p style="text-align: justify; padding-left: 15px; margin-bottom: 1">2. Adanya peningkatan mutu dan kompetensi yang berkait dengan jenjang karir karyawan.</p>
<p style="text-align: justify; padding-left: 15px;">3. Bahwa sebagai kesatuan tersebut pada butir 2 (dua) di atas, perlu dibuatkan suatu Surat Keputusan resmi.</p>
<!-- <br> -->
<?php echo "\n"; ?>
<p style="margin-bottom: 1"><b>Mengingat : </b></p>
<p style="text-align: justify;">Hasil evaluasi dan rekomendasi karyawan yang dilakukan dalam proses pengembangan organisasi dan sumber daya manusia di lingkungan Perusahaan.</p>
<br>
<!-- KOP SURAT -->

<!-- ISI -->
<h5 style="text-align: center"><b>Memutuskan : </b></h5>
<h5 style="text-align: left"><b>Menetapkan :</b></h5>
<?php echo "\n"; ?>
<p style="margin-bottom: 2;">Pertama : <b>Masa Acting Karyawan </b> di bawah ini</p>
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
            <td><?= $model->act_old_position?></td>
        </tr>
        <tr>
            <th>Posisi Acting</th>
            <td><?= $position['position_name'];?></td>
        </tr>
        <tr>
            <th>Tanggal Efektif</th>
            <td><?= $model->act_date?></td>
        </tr>
        <tr>
            <th>Berlaku Hingga</th>
            <td><?= $model->act_date_expired?></td>
        </tr>
    </table>
    <table cellpadding="2" cellspacing="2" style="margin-top: 2;">
    <tr>
			<td>Kedua</td>
			<td>:</td>
			<td>Pengaturan masa transisi peralihan tugas dan wewenang diatur tersendiri dalam pelaksanaanya.</td>
		</tr>
		<tr>
			<td>Ketiga</td>
			<td>:</td>
			<td>Surat Keputusan ini berlaku efektif 3 (tiga) bulan sejak tanggal tersebut di atas dan akan dievaluasi pada tanggal 20 Mei 2019</td>
		</tr>
    </table>
    &nbsp;
    <p style="text-align: justify;">Surat keputusan ini bisa ditinjau kembali sewaktu-waktu apabila diperlukan melalui pertimbangan dan mekanisme  yang berlaku.</p>
    &nbsp;
    <p>Ditetapkan di 	: Jakarta <br>Pada tanggal 	: <?= $model->created_at?></p>
    <!-- ISI -->

    <br>
    <br>
    <br>
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
        <td style="text-align: center;"><b>Head of Kitchen Manager</b></td>
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
