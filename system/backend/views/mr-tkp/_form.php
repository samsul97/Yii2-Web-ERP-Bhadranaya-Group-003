<?php

use backend\models\MrCctv;
use backend\models\MrCompany;
use backend\models\MrWifi;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use yii\helpers\ArrayHelper;

/* @var $this yii\web\View */
/* @var $model backend\models\MrTkp */
/* @var $form yii\widgets\ActiveForm */

$select_company = ArrayHelper::map(MrCompany::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
});

$select_cctv = ArrayHelper::map(MrCctv::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
});

$select_wifi = ArrayHelper::map(MrWifi::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
});

?>

<div class="mr-tkp-form">

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

        <div class="row">
            <div class="col-lg-6">
            <?= $form->field($model, 'code_location')->textInput() ?>
            </div>
            <div class="col-lg-6">
            <?= $form->field($model, 'code')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'alamat')->textarea(['rows' => 6]) ?>

        <?= $form->field($model, 'responbilities')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'no_hp')->textInput(['maxlength' => true]) ?>
        
        <?= $form->field($model, 'telp')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="col-lg-4">

        <?= $form->field($model, 'user_mikrotik')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'pass_mikrotik')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ip_public')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ip_office')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ip_mikrotik')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'id_cctv')->widget(Select2::classname(),[
                    'data' => $select_cctv,
                    'options' => [
                        'placeholder' => 'Pilih CCTV',
                        'value' => $model->isNewRecord ? 0 : $model->id_cctv,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
        ?>
        
        <?= $form->field($model, 'id_wifi')->widget(Select2::classname(),[
                    'data' => $select_wifi,
                    'options' => [
                        'placeholder' => 'Pilih Wifi',
                        'value' => $model->isNewRecord ? 0 : $model->id_wifi,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
        ?>
        
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

    <div class="col-lg-4">
        
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'ip_pos1')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'ip_pos2')->textInput(['maxlength' => true]) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'ip_pos3')->textInput(['maxlength' => true]) ?>
            </div>
            <div class="col-lg-6">
                <?= $form->field($model, 'ip_viewer')->textInput(['maxlength' => true]) ?>
            </div>
        </div>        

        <?= $form->field($model, 'ip_kitchen')->textInput(['maxlength' => true]) ?>

        <?= $form->field($model, 'ip_bar')->textInput(['maxlength' => true]) ?>
    </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
