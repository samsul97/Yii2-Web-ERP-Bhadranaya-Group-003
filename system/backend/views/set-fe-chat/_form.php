<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;
use kartik\switchinput\SwitchInput;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeChat */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="set-fe-chat-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
        <?= $form->field($model, 'chat_help_status', ['inputOptions' => ['id' => 'status_select2']])->widget(SwitchInput::classname(), [
            'type' => SwitchInput::CHECKBOX,
            // 'options' => ['id' => 'status-select2'],
            // 'name' => 'social_proof_status',
            'pluginOptions' => [
                'size' => 'mini',
                'onColor' => 'success',
                'offColor' => 'danger',
            ]
            ]);
        ?>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'message')->textarea(['rows' => 6]) ?>
        </div>
        <div class="col-lg-4">
        <div class="col-lg-6">
            <?= $form->field($model, 'color')->widget(ColorInput::classname(), [
                'options' => ['placeholder' => 'Select color ...'],
                ]);
            ?>
        </div>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'direct_wa')->textInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
