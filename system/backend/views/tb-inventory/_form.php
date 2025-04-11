<?php

use backend\models\User;
use backend\models\MrInParent;
use backend\models\MrInType;
use backend\models\MrInUnit;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TbInventory */
/* @var $form yii\widgets\ActiveForm */

$select_type = ArrayHelper::map(MrInType::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_unit = ArrayHelper::map(MrInUnit::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_parent = ArrayHelper::map(MrInParent::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_user = ArrayHelper::map(User::find()->where(['NOT', ['id'=>[1,2,5,6,7,8,9,10,11,12,30]]])->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

?>

<div class="tb-inventory-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'desc')->textInput(['maxlength' => true]) ?>

            <?= $form->field($model, 'id_user')->widget(Select2::classname(),[
                    'data' => $select_user,
                    'options' => [
                        'placeholder' => 'Pilih Outlet',
                        'value' => $model->isNewRecord ? 0 : $model->id_user,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'id_in_type')->widget(Select2::classname(),[
                    'data' => $select_type,
                    'options' => [
                        'placeholder' => 'Pilih Jenis',
                        'value' => $model->isNewRecord ? 0 : $model->id_in_type,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
            
            <?= $form->field($model, 'sku')->textInput(['maxlength' => true, 'readonly' => true, 'value' => $model->isNewRecord ? /*$code_gen*/ '' : $model->sku,]) ?>
        </div>

        <div class="col-lg-4">

            <?= $form->field($model, 'id_in_parent')->widget(Select2::classname(),[
                    'data' => $select_parent,
                    'options' => [
                        'placeholder' => 'Pilih Jenis',
                        'value' => $model->isNewRecord ? 0 : $model->id_in_parent,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
            
            <?= $form->field($model, 'id_in_unit')->widget(Select2::classname(),[
                    'data' => $select_unit,
                    'options' => [
                        'placeholder' => 'Pilih Unit',
                        'value' => $model->isNewRecord ? 0 : $model->id_in_unit,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'status')->widget(Select2::classname(),[
                    'data' => [ 10 => 'ACTIVE', 9 => 'INACTIVE', 0 => 'DELETED'],
                    'options' => [
                        'placeholder' => 'Pilih Status',
                        'value' => $model->isNewRecord ? 10 : $model->status,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
        </div>

        <div class="col-lg-4">
            <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'code_satuan')->textInput(['maxlength' => true]) ?>

                        <?= $form->field($model, 'code_in')->textInput(['maxlength' => true]) ?>
                    </div>

                    <div class="col-lg-6">
                        <?= $form->field($model, 'code_out')->textInput(['maxlength' => true]) ?>
                        
                        <?= $form->field($model, 'code_log')->textInput(['maxlength' => true]) ?>
                        
                        <?= $form->field($model, 'code_waste')->textInput(['maxlength' => true]) ?>
                    </div>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php

$js = <<< JS
$('#tbinventory-id_user').on('change', function (e) {
let val = $(this).val();
    $.post('generatedsku?user=' + val, function(data) {
        $('#tbinventory-sku').val(data);
    });
});
JS;


$css = <<< CSS

CSS;

$this->registerJs($js);
$this->registerCss($css);
