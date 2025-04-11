<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\MrCompany */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mr-company-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'desc')->textarea(['rows' => 6]) ?>

            <?= $form->field($model, 'address')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'vision_mision')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'products')->textarea(['rows' => 6]) ?>
        </div>
    </div>

    <hr style="border-top: 2px double #337ab7">

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'url_cpanel')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'password')->passwordInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">

            <?= $form->field($model, 'domain')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'status')->widget(Select2::classname(),[
                'data' => [ 10 => 'ACTIVE', 9 => 'INACTIVE', 0 => 'DELETED' ],
                'options' => [
                    'placeholder' => 'Pilih ...',
                    'value' => $model->isNewRecord ? 10 : $model->status,
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]) ?>

        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
