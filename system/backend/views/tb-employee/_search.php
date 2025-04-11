<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmployeeSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-employee-search">

    <?php // $form->field($model, 'id') ?>

    <?php // $form->field($model, 'nie') ?>

    <?php // $form->field($model, 'nie_old') ?>

    <?php // $form->field($model, 'nik') ?>

    <?php // $form->field($model, 'name') ?>

    <?php // echo $form->field($model, 'id_tkp') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'date_join') ?>

    <?php // echo $form->field($model, 'date_resign') ?>

    <?php // echo $form->field($model, 'department') ?>

    <?php // echo $form->field($model, 'position') ?>

    <?php // echo $form->field($model, 'pob') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'married_status') ?>

    <?php // echo $form->field($model, 'national') ?>

    <?php // echo $form->field($model, 'education') ?>

    <?php // echo $form->field($model, 'address') ?>

    <?php // echo $form->field($model, 'province') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'district') ?>

    <?php // echo $form->field($model, 'sub_district') ?>

    <?php // echo $form->field($model, 'postcode') ?>

    <?php // echo $form->field($model, 'handphone') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'image') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
        <?php // Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
