<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmployee */

$this->title = 'Sistem Lama';
$this->params['breadcrumbs'][] = ['label' => 'Sistem Lama', 'url' => ['index']];
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
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
			<div class="tb-employee-sistemlama">
                <center>
                    <a class="btn btn-primary" target='blank' href="http://192.168.50.20/employee/login_new.php" role="button">Sistem Lama</a>
                </center>
			</div>
		</div>
	</div>
</div>