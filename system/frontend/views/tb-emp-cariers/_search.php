<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TbEmpCariersSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-emp-cariers-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'address') ?>

    <?= $form->field($model, 'email') ?>

    <?= $form->field($model, 'telp') ?>

    <?php // echo $form->field($model, 'id_education') ?>

    <?php // echo $form->field($model, 'id_major') ?>

    <?php // echo $form->field($model, 'college') ?>

    <?php // echo $form->field($model, 'ipk') ?>

    <?php // echo $form->field($model, 'apprenticeship') ?>

    <?php // echo $form->field($model, 'id_reference') ?>

    <?php // echo $form->field($model, 'url') ?>

    <?php // echo $form->field($model, 'yof') ?>

    <?php // echo $form->field($model, 'yoo') ?>

    <?php // echo $form->field($model, 'cv') ?>

    <?php // echo $form->field($model, 'transcripts') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
