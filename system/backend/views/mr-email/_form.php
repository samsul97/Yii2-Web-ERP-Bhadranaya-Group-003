<?php

use backend\models\MrCompany;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;

/* @var $this yii\web\View */
/* @var $model backend\models\MrEmail */
/* @var $form yii\widgets\ActiveForm */

$select_company = ArrayHelper::map(MrCompany::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);
?>

<div class="mr-email-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
        <?= $form->field($model, 'id_company')->widget(Select2::classname(),[
                    'data' => $select_company,
                    'options' => [
                        'placeholder' => 'Pilih Company',
                        'value' => $model->isNewRecord ? 0 : $model->id_company,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
        ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-lg-4">
            <?= $form->field($model, 'pass')->passwordInput(['maxlength' => true]) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
