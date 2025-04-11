<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MrInIngredients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mr-in-ingredients-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_supplier')->textInput() ?>

    <?= $form->field($model, 'id_in_unit')->textInput() ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
