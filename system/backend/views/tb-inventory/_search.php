<?php

use backend\models\MrInType;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;

$select_type = ArrayHelper::map(MrInType::find()->orderBy(['id' => SORT_DESC])->asArray()->all(),'id', function($model, $defaultValue) {
    return $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $model backend\models\TbInventorySearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-inventory-search">

    <?php $form = ActiveForm::begin([
        'action' => ['report'],
        'method' => 'get',
    ]); ?>

    <div class="row">
        <div class="col-lg-6">
            <?php $now = new DateTime(); ?>
            <?= $form->field($model, 'updated_at')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Pilih Tanggal',
                    'autocomplete' => 'off',
                    'value' => $model->updated_at,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd',
                    'endDate'=> date_format($now, 'Y-m-d')
                    // 'startDate' => date_format($now, 'Y-m-d'), //startDate Date. Default: Beginning of time The earliest date that may be selected; all earlier dates will be disabled.
                ],
            ]) ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'id_in_type')->widget(Select2::classname(),[
                    'data' => $select_type,
                    'options' => [
                        'placeholder' => 'Pilih Jenis',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
        </div>
    </div>

    <?php //echo $form->field($model, 'id') ?>

    <?php //echo $form->field($model, 'sku') ?>

    <?php //echo $form->field($model, 'desc') ?>

    <?php //echo $form->field($model, 'induk') ?>

    <?php //echo $form->field($model, 'priority') ?>

    <?php // echo $form->field($model, 'code_satuan') ?>

    <?php // echo $form->field($model, 'code_in') ?>

    <?php // echo $form->field($model, 'code_out') ?>

    <?php // echo $form->field($model, 'code_log') ?>

    <?php // echo $form->field($model, 'code_waste') ?>

    <?php // echo $form->field($model, 'status') ?>

    <div class="col-md-12 col-md-offset-4 text-center">
        <div class="form-group">
            <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
            <?= Html::a('Reset', ['report'], ['class' => 'btn btn-default']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
// $js = <<< JS
// function editDays(date) {
// var disabledDates = ['10/26/2021', '10/26/2021', '10/26/2021'];
// for (var i = 0; i < disabledDates.length; i++) {
//     if (new Date(disabledDates[i]).toString() == date.toString()) {
//         return [false,''];
//     }
// }
// return [true,''];
// }
// JS;

// $this->registerJs($js);
?>