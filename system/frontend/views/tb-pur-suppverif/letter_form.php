<?php

use backend\models\MrBank;
use backend\models\MrBusinessfields;
use frontend\models\TbPurSuppverif;
// use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model frontend\models\TbPurSuppverif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-pur-suppverif-form">
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <b>Surat Penawaran Vendor</b>
        <hr style="border-top: 2px double #337ab7">
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'no_vendor',
                ['inputOptions' =>['id'=>'vendor-data']])
                ->textInput(['maxlength' => 11, 'onChange' => '$.post("@frontend/controllers/tb-pur-supp-verif/letter?id='.'" + $(this).val(), function(data) {
                    what = JSON.parse(data);
                    console.log(what);
                    $("#name").val(what.name);
                }
            );',]) ?>
                <div class="vendor">
                    <?= Html::label('Nama Perusahaan', 'name', ['class' => 'control-label']) ?>
                    <input type="text" class="form-control" value="<?= $name['name'] ? $name['name'] : 'Tidak ada' ?>" name="name" id="name" readonly="true">
                </div>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'offering_letter')->widget(FileInput::classname(),
                    [
                        'data' => $model->offering_letter,
                    ]);
                ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'created_at')->textInput(['value' => date('Y-m-d'), 'disabled' => true]) ?>
            </div>
        </div>
        <br>
        <h6 style="color: #dc3545">*Pastikan data yang Anda input sudah benar sebelum melakukan submit. </h6>
        <br>
    <div class="form-group">
        <?= Html::submitButton('Submit', ['class' => 'btn btn-success']) ?>
    </div>
    <?php ActiveForm::end(); ?>
</div>

<?php
$js = <<< JS
$("#vendor-data").keyup(function() {
    let filter = $(this).val();
    $.post('letter?novendor=' + filter, function(data) {
        alert(data);
        if (data) {
            $('.vendor').show();
            // css("background-color", "pink")
        }
        else {
            alert('Data tidak ada');
        }
        });
    });
JS;

$this->registerJs($js);