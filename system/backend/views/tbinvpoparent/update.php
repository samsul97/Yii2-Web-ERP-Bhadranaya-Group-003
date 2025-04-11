<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tbinvpoparent */

$this->title = 'Edit Pesanan Pembelian: ' . $model->purchase_number_parent;
$this->params['breadcrumbs'][] = ['label' => 'Pesanan Pembelian', 'url' => ['index']];
// $this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
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
			<div class="tbinvpoparent-update">
                <?= $this->render('_form', [
                    'modelParent' => $modelParent,
                    'modelsChild' => $modelsChild,
                    'modelsInv' => $modelsInv,
                ]) ?>
			</div>
		</div>
	</div>
</div>
