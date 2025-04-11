<?php

use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\TbMarProgram */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-mar-program-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-4">
            <?= $form->field($model, 'name')->textInput() ?>

            <?= $form->field($model, 'start')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Pilih Tanggal Mulai',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->start,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ]) ?>

            <?= $form->field($model, 'end')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Pilih Tanggal Berakhir',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->end,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ]) ?>
        </div>

        <div class="col-lg-4">
            <?= $form->field($model, 'reward', ['inputOptions'=>['id'=>'condition-reward']])->widget(Select2::classname(),[
                    'data' => [ 'Y' => 'IYA', 'N' => 'TIDAK'],
                    'options' => [
                        'placeholder' => 'Pilih Reward',
                        'value' => $model->isNewRecord ? $model->reward : $model->reward,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
                <div id="is_reward" style="display: none;">
                    <?= $form->field($model, 'is_reward')->textInput() ?>
                </div>
        </div>

        <div class="col-lg-4">
            <?= $form->field($model, 'permalinks')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js= <<<JS
$('#condition-reward').on('change', function (e) {
    let data = $(this).val();
    $("#is_reward").hide();
    if(data === 'Y') {
        $("#is_reward").show();
    } else if(data === 'N') {
        $("#is_reward").hide();
    }
});
JS;

return $this->registerJs($js);
?>