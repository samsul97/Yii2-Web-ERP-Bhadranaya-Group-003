<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TbEmpCariers */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-emp-cariers-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_education')->textInput() ?>

    <?= $form->field($model, 'id_major')->textInput() ?>

    <?= $form->field($model, 'college')->textInput() ?>

    <?= $form->field($model, 'ipk')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'apprenticeship')->textInput() ?>

    <?= $form->field($model, 'id_reference')->textInput() ?>

    <?= $form->field($model, 'url')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'yof')->textInput() ?>

    <?= $form->field($model, 'yoo')->textInput() ?>

    <?= $form->field($model, 'cv')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'transcripts')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'A' => 'A', 'B' => 'B', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <?= $form->field($model, 'timestamp')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
