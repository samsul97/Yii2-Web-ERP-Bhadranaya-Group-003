<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
$this->title = 'Import Fingerprint';
$this->params['breadcrumbs'][] = ['label' => 'Data Fingerprint', 'url' => ['index']];
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
            <div class="tb-emp-fingerprint-index">
                <?php $form = ActiveForm::begin(['options'=>['enctype'=>'multipart/form-data']]); ?> 
                <?= $form->field($modelImport, 'fileImport')->fileInput() ?> 
                <?= Html::submitButton('Import', ['class'=>'btn btn-primary']); ?> 
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>