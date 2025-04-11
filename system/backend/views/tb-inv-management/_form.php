<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TbInvManagement */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-inv-management-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'in_arrival')->textInput() ?>

    <?= $form->field($model, 'in_selling')->textInput() ?>

    <?= $form->field($model, 'out_sales')->textInput() ?>

    <?= $form->field($model, 'out_non_sales')->textInput() ?>

    <?= $form->field($model, 'waste')->textInput() ?>

    <?= $form->field($model, 'spoiled')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
