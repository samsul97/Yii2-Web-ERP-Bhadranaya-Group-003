<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeHeaderSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="set-fe-header-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'contact') ?>

    <?= $form->field($model, 'logo') ?>

    <?= $form->field($model, 'logo_dark') ?>

    <?php // echo $form->field($model, 'favicon') ?>

    <?php // echo $form->field($model, 'navbar_color') ?>

    <?php // echo $form->field($model, 'btn_color') ?>

    <?php // echo $form->field($model, 'social_proof_status') ?>

    <?php // echo $form->field($model, 'pause_social_proof') ?>

    <?php // echo $form->field($model, 'time_social_proof') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
