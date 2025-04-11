<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TbPurProIngredients */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-pur-pro-ingredients-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_pur_pro')->textInput() ?>

    <?= $form->field($model, 'id_ingredients')->textInput() ?>

    <?= $form->field($model, 'qty')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
