<?php

use backend\models\MrTkp;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$select_tkp = ArrayHelper::map(MrTkp::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
/* @var $this yii\web\View */
/* @var $model backend\models\TbMarCustomer */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-mar-customer-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'id_tkp')->widget(Select2::classname(),[
                    'data' => $select_tkp,
                    'options' => [
                        'placeholder' => 'Pilih TKP',
                        'value' => $model->isNewRecord ? 0 : $model->id_tkp,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
