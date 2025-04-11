<?php

use backend\models\MrBank;
use backend\models\MrCompany;
use backend\models\MrEmpLetter;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use backend\models\MrTkp;
use backend\models\TbEmpLeave;
use backend\models\TbEmpLeaveFilter;
// use kartik\detail\DetailView;
use kartik\form\ActiveForm;

$this->registerCssFile('@web/dist/css/dataTables.bootstrap4.min.css', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/jquery.dataTables.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);
$this->registerJsFile('@web/dist/js/dataTables.bootstrap4.min.js', ['depends' => [\yii\web\JqueryAsset::className()]]);

$select_tkp = ArrayHelper::map(MrTkp::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_company = ArrayHelper::map(MrCompany::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_bank = ArrayHelper::map(MrBank::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmployee */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Data Karyawan', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>

<div class="card table-card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button> -->
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <div class="tb-employee-view">
                <p>
                    <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
                    <?= Html::a('Edit', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                    <!-- <?= Html::a('Hapus', ['delete', 'id' => $model->id], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Are you sure you want to delete this item?',
                            'method' => 'post',
                        ],
                    ]) ?> -->
                </p>

                <?= DetailView::widget([
                    'model' => $model,
                    'template' => '<tr><th width="180px" style="text-align:right">{label}</th><td>{value}</td></tr>',
                    'attributes' => [
                    // 'model' => $model,
                    // 'attributes' => [
                        // 'id',
                        // [
                        //     'group' => true,
                        //     'label' => 'Data Pribadi',
                        //     'rowOptions' => ['class' => 'bg-purple'],
                        // ],
                        // [
                        //     'group' => true,
                        //     'label' => 'Data Perusahaan',
                        //     'rowOptions' => ['class' => 'bg-purple'],
                        // ],

                        // Data Pribadi
                        [
                            'format' => 'raw',
                            'attribute' => 'image',
                            'value' => function ($data) {
                                $image = $data['image'] && is_file(Yii::getAlias('@webroot') . $data['image']) ? $data['image'] : '../images/no_photo.jpg';
                                return Html::img(Url::base().$image, ['height' => '200']);
                            },
                        ],
                        'nik',
                        'npwp',
                        'name',
                        'religion',
                        'gender',
                        'pob',
                        'dob',
                        'married_status',
                        'national',
                        'education',
                        'address:ntext',
                        'sor',
                        'province',
                        'city',
                        'district',
                        'postcode',
                        'handphone',
                        'telp',
                        'email:email',

                        // Data Perusahaan
                        // 'nie_old',
                        'nie',
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_company',
                            'filter' => $select_company,
                            'value' => function ($data) {
                                $company = MrCompany::findOne($data['id_company']);
                                return $company['name'];
                            },
                        ],
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_tkp',
                            'filter' => $select_tkp,
                            'value' => function ($data) {
                                $tkp = MrTkp::findOne($data['id_tkp']);
                                return $tkp['name'];
                            },
                        ],
                        'status',
                        'status_probation',
                        'status_contract',
                        'status_resign_reason',
                        'date_join',
                        'date_resign',
                        'department',
                        'position',
                        [
                            'format' => 'raw',
                            'attribute' => 'salary',
                            'value' => function($model) {
                                $level = Yii::$app->user->identity->level;
                                // HRD LEVEL
                                if ($level == '2fae3af091b358426e15064175a896df') {
                                    return '<b> Rp.' . number_format($model->salary, 2); '</b>';
                                }
                                else {
                                    return '**********';
                                }
                            }
                        ],
                        // 'salary',
                        // Fasilitas
                        [
                            'format' => 'raw',
                            'attribute' => 'facilities',
                            'value' => function($model) {
                                if (is_array($model->facilities)) {
                                    return implode(', ', $model->facilities);
                                }
                                return $model->facilities;
                            }
                        ],
                        'fac_tj_nominal',
                        'fac_tk_nominal',
                        'fac_tbk_nominal',

                        // Bank
                        [
                            'format' => 'raw',
                            'headerOptions' => ['style' => 'text-align:center'],
                            'contentOptions' => ['style' =>'text-align:center;'],
                            'attribute' => 'id_bank',
                            'filter' => $select_bank,
                            'value' => function ($data) {
                                $bank = MrBank::findOne($data['id_bank']);
                                return $bank['name'];
                            },
                        ],
                        'account_number',

                        // Informasi lain
                        'other_information',
                    ],
                ]) ?>
            </div>
        </div>
    </div>
</div>

<div class="card table-card">
    <div class="card-header">
    <h3 class="card-title"><?php echo 'Daftar Cuti '. '<b>'. $model->name .'</b>'; ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
			<div class="record-leave-view">
                <!-- <div class="row"> -->
                    <div class="table-responsive table-nowrap">
                        <table class="table table-bordered table-nowrap table-leave">
                            <thead>
                                <tr>
                                    <!-- <th width="10">No</th> -->
                                    <th>Tipe Cuti</th>
                                    <th>Mulai Tanggal</th>
                                    <th>Sampai Tanggal</th>
                                    <th>Alasan</th>
                                    <th>Tanggal Pengajuan</th>
                                    <th>Jumlah Cuti</th>
                                </tr>
                                <!-- <tr>Sisa Cuti</tr> -->
                            </thead>
                            <tbody>
                            <?php foreach ($model->detailLeave() as $leave): ?>
                                <tr>
                                    <td><?= $leave->leave_type?></td>
                                    <td><?= Html::a($leave->start_date); ?></td>
                                    <td><?= Html::a($leave->till_date); ?></td>
                                    <td><?= Html::a($leave->reason); ?></td>
                                    <td><?= Html::a($leave->dof); ?></td>
                                    <td><?= Html::a($leave->dof); ?></td>
                                </tr>
                            <?php endforeach ?>
                            <thead>
                            <tr>
                                <td colspan="5" style="text-align: right;">Total Cuti Keseluruhan : </td>
                                <?php
                                $check = TbEmpLeaveFilter::find()->where(['id_employee' => $model->id])->all();
                                $sum = TbEmpLeaveFilter::find()->where(['id_employee' => $check])->sum('leave_total');
                                ?>
                                <td><?php echo $sum ? $sum : 'Belum Cuti';?></td>
                            </tr>
                            <!-- <tr>
                                <td colspan="5" style="text-align: right;">Sisa Cuti : </td>
                                <td>0</td>
                            </tr> -->
                            </thead>
                        </tbody>
                        </table>
                    </div>
                <!-- </div> -->
			</div>
		</div>
	</div>
</div>

<div class="card table-card">
    <div class="card-header">
    <h3 class="card-title"><?php echo 'Daftar Surat '. '<b>'. $model->name .'</b>'; ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
			<div class="record-administration-view">
                <!-- <div class="row"> -->
                    <div class="table-responsive table-nowrap">
                        <table class="table table-bordered table-nowrap table-correspondence">
                            <thead>
                                <tr>
                                    <!-- <th width="10">No</th> -->
                                    <th>Tipe Surat</th>
                                    <th>No Surat</th>
                                    <th>Isi Surat</th>
                                    <th>Bulan</th>
                                    <th>Tahun</th>
                                    <th>Tanggal Buat</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($model->detailCorrespondence() as $correspondence): ?>
                                <tr>
                                <?php $letter_type = MrEmpLetter::findOne($correspondence['id_letter']); ?>
                                    <!-- <td><?= $no; ?></td> -->
                                    <td><?= Html::a($letter_type['name'], ['tb-emp-administration/view', 'id' => $letter_type->id]); ?></td>
                                    <td><?= Html::a($correspondence->no_letter); ?></td>
                                    <td><?= Html::a($correspondence->contents); ?></td>
                                    <td><?= Html::a($correspondence->no_month); ?></td>
                                    <td><?= Html::a($correspondence->year); ?></td>
                                    <td><?= Html::a($correspondence->created_at); ?></td>
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

<div class="card table-card">
    <div class="card-header">
    <h3 class="card-title"><?php echo 'Jejak Lokasi Kerja '. '<b>'. $model->name .'</b>'; ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
			<div class="record-tkp-view">
                <!-- <div class="row"> -->
                    <div class="table-responsive table-nowrap">
                        <table class="table table-bordered table-nowrap">
                            <thead>
                                <tr>
                                    <!-- <th width="10">No</th> -->
                                    <th>Lokasi Kerja Sebelumnya</th>
                                    <th>Lokasi Kerja Sekarang</th>
                                    <th>Tanggal Pindah Lokasi</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($model->detailRecordTkp() as $rec_tkp): ?>
                                <?php $tkp_origin = MrTkp::findOne($rec_tkp['id_tkp_origin']); ?>
                                <?php $tkp_destination = MrTkp::findOne($rec_tkp['id_tkp_destination']); ?>
                                <tr>
                                    <!-- <td><?= $no; ?></td> -->
                                    <td><?= Html::a($tkp_origin['name']); ?></td>
                                    <td><?= Html::a($tkp_destination['name']); ?></td>
                                    <td><?= Html::a($rec_tkp->dot); ?></td>
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

<div class="card table-card">
    <div class="card-header">
    <h3 class="card-title"><?php echo 'Jejak Kontrak '. '<b>'. $model->name .'</b>'; ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
			<div class="record-contract-view">
                <!-- <div class="row"> -->
                    <div class="table-responsive table-nowrap">
                        <table class="table table-bordered table-nowrap">
                            <thead>
                                <tr>
                                    <!-- <th width="10">No</th> -->
                                    <th>Kontrak Kerja Sebelumnya</th>
                                    <th>Kontrak Kerja Sekarang</th>
                                    <th>Di Update Pada Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $no=1; foreach ($model->detailRecordContract() as $rec_contract): ?>
                                <tr>
                                    <!-- <td><?= $no; ?></td> -->
                                    <td><?= Html::a($rec_contract->status_contract_origin); ?></td>
                                    <td><?= Html::a($rec_contract->status_contract_destination); ?></td>
                                    <td><?= Html::a($rec_contract->doc); ?></td>
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

var t = $('.table-leave').DataTable({
    "order": [[ 3, "desc" ]],
    "columnDefs": [
        { "orderable": false, "targets": 0 }
      ]
});

var u = $('.table-correspondence').DataTable({
    "order": [[ 3, "desc" ]],
    "columnDefs": [
        { "orderable": false, "targets": 0 }
      ]
});

// var v = $('.table-tkp').DataTable({
//     "order": [[ 3, "desc" ]],
//     "columnDefs": [
//         { "orderable": false, "targets": 0 }
//       ]
// });

// var w = $('.table-contract').DataTable({
//     "order": [[ 3, "desc" ]],
//     "columnDefs": [
//         { "orderable": false, "targets": 0 }
//       ]
// });

t.on( 'order.dt search.dt', function () {
    t.column(0, {search:'applied', order:'applied'}).nodes().each( function (cell, i) {
        cell.innerHTML = i+1;
    } );
} ).draw();

u.on( 'order.dt search.dt', function () {
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






