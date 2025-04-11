<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MrWifiSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mr-wifi-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'url') ?>

    <?= $form->field($model, 'vendor') ?>

    <?= $form->field($model, 'ssid') ?>

    <?php // echo $form->field($model, 'username_modem') ?>

    <?php // echo $form->field($model, 'pasword_modem') ?>

    <?php // echo $form->field($model, 'username_login') ?>

    <?php // echo $form->field($model, 'password_login') ?>

    <?php // echo $form->field($model, 'speed') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
