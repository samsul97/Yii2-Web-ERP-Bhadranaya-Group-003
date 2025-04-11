<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\color\ColorInput;
use kartik\switchinput\SwitchInput;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeHeader */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="set-fe-header-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
            <?= $form->field($model, 'contact')->textInput(['maxlength' => true]) ?>
            <div class="row">
                <div class="col-lg-6">
                    <?= $form->field($model, 'navbar_color')->widget(ColorInput::classname(), [
                    'options' => ['placeholder' => 'Select color ...'],
                    ]);
                    ?>
                </div>
                <div class="col-lg-6">
                    <?= $form->field($model, 'btn_color')->widget(ColorInput::classname(), [
                    'options' => ['placeholder' => 'Select color ...'],
                    ]);
                    ?>
                </div>
            </div>
            <?= $form->field($model, 'social_proof_status', ['inputOptions' => ['id' => 'status_select2']])->widget(SwitchInput::classname(), [
                'type' => SwitchInput::CHECKBOX,
                // 'options' => ['id' => 'status-select2'],
                'name' => 'social_proof_status',
                'pluginOptions' => [
                    'size' => 'mini',
                    'onColor' => 'success',
                    'offColor' => 'danger',
                ]
                ]);
            ?>

            <div class="row">
                <div class="col-lg-6">
                    <div id="status_pause" style="display: none;">
                        <?= $form->field($model, 'pause_social_proof')->textInput() ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div id="status_time" style="display: none;">
                        <?= $form->field($model, 'time_social_proof')->textInput() ?>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <?php
                $image = $model->logo && is_file(Yii::getAlias('@webroot') . $model->logo) ? $model->logo : '/images/no_photo_box.jpg';
            ?>
            <?= $form->field($model, 'logo', [
                    'template' => '
                    {label}
                    <div id="preview">
                    <img id="img-preview" src="'. Url::base() . $image .'" alt="Logo" />
                    </div>
                    {input}
                    {error}',
                ])->fileInput(['accept' => 'image/*'])
            ?>
            <?php
                $image2 = $model->logo_dark && is_file(Yii::getAlias('@webroot') . $model->logo_dark) ? $model->logo_dark : '/images/no_photo_box.jpg';
            ?>
            <?= $form->field($model, 'logo_dark', [
                    'template' => '
                    {label}
                    <div id="preview">
                    <img id="img-preview2" src="'. Url::base() . $image2 .'" alt="Logo Dark" />
                    </div>
                    {input}
                    {error}',
                ])->fileInput(['accept' => 'image/*'])
            ?>
            <?php
                $image3 = $model->favicon && is_file(Yii::getAlias('@webroot') . $model->favicon) ? $model->favicon : '/images/no_photo_box.jpg';
            ?>
            <?= $form->field($model, 'favicon', [
                    'template' => '
                    {label}
                    <div id="preview">
                    <img id="img-preview3" src="'. Url::base() . $image3 .'" alt="Favicon" />
                    </div>
                    {input}
                    {error}',
                ])->fileInput(['accept' => 'image/*'])
            ?>
        </div>
    </div>
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<< JS

$('#setfeheader-logo').on('change', function(e) {
    e.preventDefault();
    readURL(this);
});

$('#setfeheader-logo_dark').on('change', function(e) {
    e.preventDefault();
    readURL2(this);
});

$('#setfeheader-favicon').on('change', function(e) {
    e.preventDefault();
    readURL3(this);
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

function readURL2(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview2').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#img-preview2').attr('src', '$image2');
    }
}

function readURL3(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview3').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#img-preview3').attr('src', '$image3');
    }
}

$('#status-select2').on('change', function (e) {
    alert(e);
    let data = $(this).val();
    $("#status_pause").show();
    $("#status_time").show();
    if(data === 0) {
        $("#status_pause").show();
        $("#status_time").show();
    } else if(data === 1) {
        $("#status_pause").hide();
        $("#status_time").hide();
    }
});

JS;

$css = <<< CSS

#preview {
    border: 1px solid #ddd;
    padding: 20px;
    margin: 0 0 20px;
}

#preview img {
    width: 100%;
    max-height: 250px;
}

CSS;

$this->registerJs($js);
$this->registerCss($css);