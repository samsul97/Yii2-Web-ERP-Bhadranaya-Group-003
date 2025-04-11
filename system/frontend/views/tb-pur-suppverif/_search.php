<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TbPurSuppverifSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-pur-suppverif-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'type_business') ?>

    <?= $form->field($model, 'img_nib') ?>

    <?= $form->field($model, 'img_npwp') ?>

    <?= $form->field($model, 'img_directur') ?>

    <?php // echo $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'residence_address') ?>

    <?php // echo $form->field($model, 'letter_address') ?>

    <?php // echo $form->field($model, 'telp') ?>

    <?php // echo $form->field($model, 'facsimile') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'id_tb_bf') ?>

    <?php // echo $form->field($model, 'id_bank') ?>

    <?php // echo $form->field($model, 'account_number') ?>

    <?php // echo $form->field($model, 'swift_code') ?>

    <?php // echo $form->field($model, 'payment_method') ?>

    <?php // echo $form->field($model, 'offering_letter') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
