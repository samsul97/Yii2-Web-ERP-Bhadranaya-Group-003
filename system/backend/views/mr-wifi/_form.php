<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MrWifi */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mr-wifi-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'vendor')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'ssid')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'username_login')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'password_login')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'username_modem')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'pasword_modem')->textInput(['maxlength' => true]) ?>
            
            <?= $form->field($model, 'speed')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
