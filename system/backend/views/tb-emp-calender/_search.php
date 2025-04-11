<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpCalenderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-emp-calender-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_calender') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'id_tkp') ?>

    <?= $form->field($model, 'necessity') ?>

    <?php // echo $form->field($model, 'vehicle') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
