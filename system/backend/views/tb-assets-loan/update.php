<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbAssetsLoan */

$this->title = 'Update Tb Assets Loan: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Assets Loans', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-assets-loan-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
