<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\number\NumberControl;

/* @var $this yii\web\View */
/* @var $model backend\models\TbAssetsBroken */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-assets-broken-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'status', ['inputOptions'=>['id'=>'status-select2']])->widget(Select2::classname(),[
            'data' => [ 'Dijual' => 'DIJUAL', 'Dibuang' => 'DIBUANG',],
            'options' => [
                'placeholder' => 'Status',
                'value' => $model->status,
            ],
            'pluginOptions' => [
                'allowClear' => false
            ],
        ]);
    ?>
    
    <div id="is_sale_price" style="display: none">
        <?= $form->field($model, 'is_sale_price')->widget(NumberControl::classname(), [
            'data' => 'number-decimal',
            'displayOptions' => [
                'placeholder' => 'Harga Jual',
            ],
            'maskedInputOptions' => [
                'digits' => 0,
                'alias' => 'numeric',
                'groupSeparator' => '.',
                'autoGroup' => true,
                'autoUnmask' => true,
                'unmaskAsNumber' => true,
            ],
        ]);
        ?>
    </div>

    <div id="is_sale_where" style="display: none">
        <?= $form->field($model, 'is_sale_where')->textarea(['rows' => 6, 'placeholder' => 'Ket. Tambahan, dijual kemana dan ke siapa...']) ?>
    </div>

    <div id="is_waste_where" style="display: none">
        <?= $form->field($model, 'is_waste_where')->textarea(['rows' => 6, 'placeholder' => 'Ket. Tambahan, dibuang kemana dan ke siapa...']) ?>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<< JS
$('#status-select2').on('change', function (e) {
    let data = $(this).val();
    $("#is_sale_price").hide();
    $("#is_sale_where").hide();
    $("#is_waste_where").hide();
    if(data === 'Dijual') {
        $("#is_sale_price").show();
        $("#is_sale_where").show();
        $("#is_waste_where").hide();
    } else if(data === 'Dibuang') {
        $("#is_sale_price").hide();
        $("#is_sale_where").hide();
        $("#is_waste_where").show();
    }
});
JS;

$this->registerJs($js);