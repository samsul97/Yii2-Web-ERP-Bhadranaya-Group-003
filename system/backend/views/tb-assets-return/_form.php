<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TbAssetsReturn */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-assets-return-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'id_loan')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'condition')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'dor')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
