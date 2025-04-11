<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpLeave */

$this->title = 'Tambah Cuti';
$this->params['breadcrumbs'][] = ['label' => 'Data Cuti', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
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
			<div class="tb-emp-leave-create">
                <!-- <div class="card-body">
                    <div class="alert alert-info alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                            <h6><i class="icon fas fa-birthday-cake"></i> Karyawan berhak mendapatkan cuti 12 kali selama 1 tahun</h6>
                    </div>
                </div> -->
                <?= $this->render('_form', [
                    'model' => $model,
                    'employees' => $employees,
                    // 'default_leave_years' => $default_leave_years,
                ]) ?>
		    </div>
	    </div>
    </div>
</div>
