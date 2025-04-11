<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MrCariers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mr-cariers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'city_name')->dropDownList([ 'JAKARTA' => 'JAKARTA', 'TANGERANG' => 'TANGERANG', 'DEPOK' => 'DEPOK', 'BANDUNG' => 'BANDUNG', 'SEMARANG' => 'SEMARANG', 'PKU' => 'PKU', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'position_name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'ACTIVE' => 'ACTIVE', 'INACTIVE' => 'INACTIVE', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
