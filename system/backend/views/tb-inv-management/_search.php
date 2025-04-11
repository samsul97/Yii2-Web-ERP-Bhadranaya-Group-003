<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TbInvManagementSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-inv-management-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'in_arrival') ?>

    <?= $form->field($model, 'in_selling') ?>

    <?= $form->field($model, 'out_sales') ?>

    <?= $form->field($model, 'out_non_sales') ?>

    <?php // echo $form->field($model, 'waste') ?>

    <?php // echo $form->field($model, 'spoiled') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
