<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeFooter3Help */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="set-fe-footer3-help-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_menu')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
