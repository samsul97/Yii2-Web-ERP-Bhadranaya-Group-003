<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbMarDiscount */

$this->title = 'Create Tb Mar Discount';
$this->params['breadcrumbs'][] = ['label' => 'Tb Mar Discounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-mar-discount-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
