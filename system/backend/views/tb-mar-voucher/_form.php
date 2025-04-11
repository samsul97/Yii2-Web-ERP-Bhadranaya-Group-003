<?php

use kartik\date\DatePicker;
use kartik\number\NumberControl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TbMarVoucher */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-mar-voucher-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">

            <?= $form->field($model, 'value')->widget(NumberControl::classname(), [
                'data' => 'number-decimal',
                'displayOptions' => [
                    'placeholder' => 'Nilai',
                ],
                'maskedInputOptions' => [
                    'digits' => 0,
                    'alias' => 'numeric',
                    'groupSeparator' => '.',
                    'autoGroup' => true,
                    'autoUnmask' => true,
                    'unmaskAsNumber' => true,
                ],
            ]); ?>
            
            <?= $form->field($model, 'max_value')->widget(NumberControl::classname(), [
                'data' => 'number-decimal',
                'displayOptions' => [
                    'placeholder' => 'Nilai Maksimal',
                ],
                'maskedInputOptions' => [
                    'digits' => 0,
                    'alias' => 'numeric',
                    'groupSeparator' => '.',
                    'autoGroup' => true,
                    'autoUnmask' => true,
                    'unmaskAsNumber' => true,
                ],
            ]); ?>

            <?= $form->field($model, 'expired_date')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Tanggal Kadaluarsa Voucher',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->expired_date,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
