<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpCalender */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-emp-calender-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_calender')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'id_tkp')->textInput() ?>

    <?= $form->field($model, 'necessity')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'vehicle')->dropDownList([ 'Motor' => 'Motor', 'Mobil' => 'Mobil', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
