<?php

use backend\models\MrInCategory;
use backend\models\MrTkp;
use backend\models\TbAssets;
use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use kartik\form\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use kartik\number\NumberControl;
use yii\helpers\Url;
// use shaqman\widgets\inlinescript\InlineScript;
/* @var $this yii\web\View */
/* @var $model backend\models\TbAssets */
/* @var $form yii\widgets\ActiveForm */

$select_tkp = ArrayHelper::map(MrTkp::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_category = ArrayHelper::map(MrInCategory::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

?>


<div class="tb-assets-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">

    <div class="col-lg-4">
        <?php
            $image = $model->image && is_file(Yii::getAlias('@webroot') . $model->image) ? $model->image : '/images/no_photo_box.jpg';
        ?>
        <?= $form->field($model, 'image', [
                'template' => '
                {label}
                <div id="preview">
                <img id="img-preview" src="'. Url::base() . $image .'" alt="assets image" />
                </div>
                {input}
                {error}',
            ])->fileInput(['accept' => 'image/*'])
        ?>

        <?= $form->field($model, 'id_in_category')->widget(Select2::classname(),[
                'data' => $select_category,
                'options' => [
                    'placeholder' => 'Pilih Kategori',
                    'value' => $model->isNewRecord ? 0 : $model->id_in_category,
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]);
        ?>

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
    <div class="col-lg-4">
    <!-- <?= $form->field($model, 'sku')->textInput(['maxlength' => true, 'readonly'=> true, 'value' => $model->isNewRecord ? /*$code_gen*/ '' : $model->sku, 'placeholder' => 'Nomor Barang']) ?> -->
    <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Nama Barang']) ?>        
        <div class="row">
            <div class="col-lg-6">
                <?= $form->field($model, 'price')->widget(NumberControl::classname(), [
                    'data' => 'number-decimal',
                    'displayOptions' => [
                        'placeholder' => 'Harga',
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
            <div class="col-lg-6">
                <?= $form->field($model, 'brand')->textInput(['maxlength' => true, 'placeholder' => 'Merk/Brand']) ?>  
            </div>
        </div>
        
        <!-- <div>&nbsp;</div> -->

        <?= $form->field($model, 'completeness')->textarea(['rows' => 6, 'placeholder' => 'Kelengkapan Barang']) ?>

        <?= $form->field($model, 'qty')->textInput(['type' => 'number', 'min' => 0, 'value' => $model->isNewRecord ? 0 : null]) ?>
        
    </div>

    <div class="col-lg-4">
    <?= $form->field($model, 'contractor')->textInput(['maxlength' => true, 'placeholder' => 'Kontraktor']) ?>
    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'power', [ 'template' => '
                {label}
                <div class="input-group">
                {input}
                <span class="input-group-text" id="basic-addon1">WATT</span>
                </div>
                {hint}
                {error}',
                'options' => ['class' => 'has-feedback']])->textInput(['maxlength' => true, 'placeholder' => 'Daya'])
            ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'floor')->textInput(['maxlength' => true, 'placeholder' => 'Lantai']) ?>
        </div>
    </div>
    <?= $form->field($model, 'dop')->widget(DatePicker::classname(), [
            'options' => [
                'placeholder'  => 'Pilih Tanggal Beli',
                'autocomplete' => 'off',
                'value' => $model->isNewRecord ? date('Y-m-d') : $model->dop,
            ],
            'pluginOptions' => [
                'autoclose'      => true,
                'todayHighlight' => true,
                'format'         => 'yyyy-mm-dd'
            ]
        ]) ?>
        <?= $form->field($model, 'guarantee')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Tanggal Garansi',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->guarantee,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ])
        ?>
        
        

        <?= $form->field($model, 'other_information')->textInput(['maxlength' => true, 'placeholder' => 'Kosongkan jika tidak ada' ]) ?>
    </div>

    </div>

    <div class="form-group">
        <?= Html::submitButton('Simpan', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Batal', ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<< JS

// $('#tbassets-id_in_category').on('change', function (e) {
// let val = $(this).val();
//     $.post('generated?kategori=' + val, function(data) {
//         $('#tbassets-sku').val(data);
//     });
// });

// $('.skuChange').on('change', function (e) {
//     let val_kategori = $(this).val();
//     let val_tkp = $(this).val();
//     alert($(this).val());
//     $.post('generated?tkp=' + val_tkp + '&generated?kategori=' + val_kategori, function(data) {
//         $('#tbassets-sku').val(data);
//     });
// });

$('#condition-select2').on('change', function (e) {
    let data = $(this).val();
    $("#condition_issue_container_id").hide();
    $("#status_container_id").hide();
    if(data === 'Abnormal') {
        $("#condition_issue_container_id").show();
        $("#status_container_id").show();
    } else if(data === 'Broken') {
        $("#condition_issue_container_id").show();
        $("#status_container_id").hide();
    }
});

$('#tbassets-image').on('change', function(e) {
    e.preventDefault();
    readURL(this);
});

function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#img-preview').attr('src', '$image');
    }
}

JS;

$css = <<< CSS

#preview {
    border: 1px solid #ddd;
    padding: 20px;
    margin: 0 0 20px;
}

#preview img {
    width: 100%;
    max-height: 220px;
}

CSS;

$this->registerJs($js);
$this->registerCss($css);