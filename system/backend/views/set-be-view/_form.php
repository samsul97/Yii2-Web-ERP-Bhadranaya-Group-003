<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SetBeView */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="set-be-view-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'header_side_logo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'header_side_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'navbar_main_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'navbar_btn_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'sidebar_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'footer_color')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'footer_content')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'favicon')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
