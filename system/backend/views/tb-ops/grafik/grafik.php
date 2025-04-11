<?php
use yii\helpers\Html;

$this->params['breadcrumbs'][] = ['label' => 'Compliment Sales TKP', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->title = 'Compliment Sales TKP';
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
			<div class="compliment-sales-tkp">
				<div class="row">
					<div class="col">
                        <p>Compliment Sales TKP</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>