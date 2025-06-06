<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TbAssetsLoanSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-assets-loan-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_assets') ?>

    <?= $form->field($model, 'id_employee') ?>

    <?= $form->field($model, 'id_user') ?>

    <?= $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'dol') ?>

    <?php // echo $form->field($model, 'dor') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
