<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\MrInType */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mr-in-type-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'priority')->textInput() ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'status')->widget(Select2::classname(),[
                    'data' => [ 10 => 'ACTIVE', 9 => 'INACTIVE', 0 => 'DELETED' ],
                    'options' => [
                        'placeholder' => 'Pilih ...',
                        'value' => $model->isNewRecord ? 10 : $model->status,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ])
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
