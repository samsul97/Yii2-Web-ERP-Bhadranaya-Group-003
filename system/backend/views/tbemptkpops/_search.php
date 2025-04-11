<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MpGradeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbemptkpops-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'no_receipt') ?>

    <?= $form->field($model, 'id_tkp_from') ?>

    <?= $form->field($model, 'id_tkp_destination') ?>

    <?= $form->field($model, 'id_user') ?>

    <?php // echo $form->field($model, 'pic') ?>

    <?php // echo $form->field($model, 'necessity') ?>

    <?php // echo $form->field($model, 'note') ?>

    <?php // echo $form->field($model, 'deadline') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
