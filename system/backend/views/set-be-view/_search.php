<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SetBeViewSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="set-be-view-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'header_side_logo') ?>

    <?= $form->field($model, 'header_side_color') ?>

    <?= $form->field($model, 'navbar_main_color') ?>

    <?= $form->field($model, 'navbar_btn_color') ?>

    <?php // echo $form->field($model, 'sidebar_color') ?>

    <?php // echo $form->field($model, 'footer_color') ?>

    <?php // echo $form->field($model, 'footer_content') ?>

    <?php // echo $form->field($model, 'favicon') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
