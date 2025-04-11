<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TbPurSuppverif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-pur-suppverif-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'type_business')->dropDownList([ 'PT' => 'PT', 'CV' => 'CV', 'PD' => 'PD', 'PERORANGAN' => 'PERORANGAN', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'img_nib')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img_npwp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'img_directur')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'residence_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'letter_address')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'facsimile')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_tb_bf')->textInput() ?>

    <?= $form->field($model, 'id_bank')->textInput() ?>

    <?= $form->field($model, 'account_number')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'swift_code')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'payment_method')->dropDownList([ 'TRANSFER' => 'TRANSFER', 'CHEQUE' => 'CHEQUE', 'GIRO' => 'GIRO', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'offering_letter')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
