<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbMarDiscount */

$this->title = 'Update Tb Mar Discount: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Mar Discounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-mar-discount-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
