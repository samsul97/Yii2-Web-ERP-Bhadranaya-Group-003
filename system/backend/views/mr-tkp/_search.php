<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\MrTkpSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mr-tkp-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'id_company') ?>

    <?= $form->field($model, 'code_location') ?>

    <?= $form->field($model, 'name') ?>

    <?= $form->field($model, 'code') ?>

    <?php // echo $form->field($model, 'alamat') ?>

    <?php // echo $form->field($model, 'responbilities') ?>

    <?php // echo $form->field($model, 'no_hp') ?>

    <?php // echo $form->field($model, 'telp') ?>

    <?php // echo $form->field($model, 'ip_viewer') ?>

    <?php // echo $form->field($model, 'ip_pos1') ?>

    <?php // echo $form->field($model, 'ip_pos2') ?>

    <?php // echo $form->field($model, 'ip_pos3') ?>

    <?php // echo $form->field($model, 'ip_kitchen') ?>

    <?php // echo $form->field($model, 'ip_bar') ?>

    <?php // echo $form->field($model, 'ip_public') ?>

    <?php // echo $form->field($model, 'ip_office') ?>

    <?php // echo $form->field($model, 'ip_mikrotik') ?>

    <?php // echo $form->field($model, 'pass_mikrotik') ?>

    <?php // echo $form->field($model, 'user_mikrotik') ?>

    <?php // echo $form->field($model, 'id_cctv') ?>

    <?php // echo $form->field($model, 'id_wifi') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'created_at') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
