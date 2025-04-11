<?php

use backend\models\MrBank;
use backend\models\MrBusinessfields;
use backend\models\User;
use kartik\file\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
// use kartik\form\ActiveForm;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Url;


$select_tb_bf = ArrayHelper::map(MrBusinessfields::find()->asArray()->all(), 'id', function($model, $defaultValue) {
    return $model['name'];
}
);

$select_bank = ArrayHelper::map(MrBank::find()->asArray()->all(), 'id', function($model, $defaultValue) {
    return $model['name'];
}
);
$arr = [5, 7, 9, 10, 12];
$select_user = ArrayHelper::map(User::find()->where(['id'=>$arr])->all(), 'id', function($model, $defaultValue) {
    return $model['name'];
}
);

/* @var $this yii\web\View */
/* @var $model frontend\models\TbPurSuppverif */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-pur-suppverif-form">

    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
        <b>Data Perusahaan</b>
        <hr style="border-top: 2px double #337ab7">

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'type_business')->widget(Select2::classname(),[
                        'data' => [ 'PT' => 'PT', 'CV' => 'CV', 'PD' => 'PD', 'PERORANGAN' => 'PERORANGAN'],
                        'options' => [
                            'placeholder' => 'Pilih Tipe Bisnis',
                            'value' => $model->isNewRecord ? 'PT' : $model->type_business,
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ]);
                ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'id_tb_bf')->widget(Select2::classname(),[
                        'data' => $select_tb_bf,
                        'options' => [
                            'placeholder' => 'Pilih Bidang Usaha',
                            'value' => $model->isNewRecord ? 11 : $model->id_tb_bf,
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ]);
                ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'tb_bf_etc')->textInput(['maxlength' => true]) ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Nama Perusahaan']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'telp')->textInput(['maxlength' => true, 'placeholder' => 'Telp']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'residence_address')->textarea(['rows' => 6, 'placeholder' => 'Alamat Domisili']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'letter_address')->textarea(['rows' => 6, 'placeholder' => 'Alamat Surat']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'facsimile')->textInput(['maxlength' => true, 'placeholder' => 'Faksimile']) ?>
                <?= Html::label('Divisi', 'divisi', ['class' => 'control-label']) ?>
                <?= Select2::widget([
                    'name' => 'id_user',
                    'data' => $select_user,
                    'options' => [
                        'placeholder' => 'Pilih Divisi',
                        'value' => $model->isNewRecord ? $model->isNewRecord : $model->id_user,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]) ?>
                <?php echo '<span style="color: red;">*Silahkan isi sesuai dengan divisi yang Anda tuju</span>' ?>
            </div>
        </div>
        
        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'sk_menkeh')->widget(FileInput::classname(),
                    [
                        'data' => $model->sk_menkeh,
                        // 'options' => ['multiple' => true],
                    ]);
                ?>
            </div>
            <div class="col-lg-4">
                <?php
                    $image1 = $model->img_nib && is_file(Yii::getAlias('@webroot') . $model->img_nib) ? $model->img_nib : '/frontend/img_static/no_photo.jpg';
                ?>
                <?= $form->field($model, 'img_nib', [
                        'template' => '
                        {label}
                        <div id="preview">
                        <img id="img-preview1" src="'. Url::base() . $image1 .'" alt="NIB IMAGE" />
                        </div>
                        {input}
                        {error}',
                        ])->fileInput(['accept' => 'image/*'])
                ?>
            </div>
            <div class="col-lg-4">
                <?php
                    $image2 = $model->img_npwp && is_file(Yii::getAlias('@webroot') . $model->img_npwp) ? $model->img_npwp : '/frontend/img_static/no_photo.jpg';
                ?>
                <?= $form->field($model, 'img_npwp', [
                    'template' => '
                        {label}
                        <div id="preview">
                        <img id="img-preview2" src="'. Url::base() . $image2 .'" alt="NPWP IMAGE" />
                        </div>
                        {input}
                        {error}',
                        ])->fileInput(['accept' => 'image/*'])
                        ?>
            </div>
        </div>
        <br>
            
        <b>Direktur/Direktur Utama</b>
        <hr style="border-top: 2px double #337ab7">

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'telp_dr')->textInput(['maxlength' => true, 'placeholder' => 'Telp Direktur']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'email_dr')->textInput(['maxlength' => true, 'placeholder' => 'Email Direktur']) ?>
            </div>
            <div class="col-lg-4">
                <?php
                    $image3 = $model->img_directur && is_file(Yii::getAlias('@webroot') . $model->img_directur) ? $model->img_directur : '/frontend/img_static/no_photo.jpg';
                ?>
                <?= $form->field($model, 'img_directur', [
                    'template' => '
                    {label}
                    <div id="preview">
                    <img id="img-preview3" src="'. Url::base() . $image3 .'" alt="DIRECTUR IMAGE" />
                    </div>
                    {input}
                    {error}',
                    ])->fileInput(['accept' => 'image/*'])
                    ?>
            </div>
        </div>
        <br>

        <b>Kontak Person Sales</b>
        <hr style="border-top: 2px double #337ab7">

        <div class="row">
            <div class="col-lg-4">
                <?= $form->field($model, 'name_sl')->textInput(['maxlength' => true, 'placeholder' => 'Nama Sales']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'no_sl')->textInput(['maxlength' => true, 'placeholder' => 'Nomor Sales']) ?>
            </div>
            <div class="col-lg-4">
                <?= $form->field($model, 'email_sl')->textInput(['maxlength' => true, 'placeholder' => 'Email Sales']) ?>
            </div>
        </div>

        <b>Rekening Bank</b>
        <hr style="border-top: 2px double #337ab7">

        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'id_bank')->widget(Select2::classname(),[
                        'data' => $select_bank,
                        'options' => [
                            'placeholder' => 'Pilih Bank',
                            'value' => $model->isNewRecord ? 1 : $model->id_bank,
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ]);
                ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'branch_bank')->textInput(['maxlength' => true, 'placeholder' => 'Bank Cabang']) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'account_number')->textInput(['maxlength' => true, 'placeholder' => 'Nomor Rekening']) ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'swift_code')->textInput(['maxlength' => true, 'placeholder' => 'Swift Code']) ?>
            </div>
        </div>

        <div class="row">
            <div class="col-lg-3">
                <?= $form->field($model, 'payment_method')->widget(Select2::classname(),[
                        'data' => [ 'TRANSFER' => 'TRANSFER', 'CHEQUE' => 'CHEQUE', 'GIRO' => 'GIRO', 'COD' => 'CASH ON DELIVERY'],
                        'options' => [
                            'placeholder' => 'Pilih Metode Pembayaran',
                            'value' => $model->isNewRecord ? 'TRANSFER' : $model->payment_method,
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ]);
                ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'top')->widget(Select2::classname(),[
                        'data' => [ 'TOP' => 'TOP 30 HARI', 'COD' => 'CASH ON DELIVERY'],
                        'options' => [
                            'placeholder' => 'Pilih Terms Of Payment',
                            'value' => $model->isNewRecord ? 'TOP' : $model->top,
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ]);
                ?>
            </div>
            <div class="col-lg-3">
                <?= $form->field($model, 'offering_letter')->widget(FileInput::classname(),
                    [
                        'data' => $model->offering_letter,
                        // 'options' => ['multiple' => true],
                    ]);
                ?>
            </div>
            <div class="col-lg-3">
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

$('#tbpursuppverif-img_nib').on('change', function(e) {
    e.preventDefault();
    readURL(this);
});

$('#tbpursuppverif-img_npwp').on('change', function(e) {
    e.preventDefault();
    readURL2(this);
});

$('#tbpursuppverif-img_directur').on('change', function(e) {
    e.preventDefault();
    readURL3(this);
});

// $('#tbpursuppverif-sk_menkeh').on('change', function(e) {
//     e.preventDefault();
//     readURL4(this);
// });


function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function (e) {
            $('#img-preview1').attr('src', e.target.result);
        };
        reader.readAsDataURL(input.files[0]);
    } else {
        $('#img-preview1').attr('src', '$image1');
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

$('#tbpursuppverif-id_tb_bf').on('change', function (e) {
    // $('#tbpursuppverif-tb_bf_etc').attr('disabled','disabled');
    let data = $(this).val();
    if(data == 11) {
        // alert('Bidang usaha lain-lain di buka');
        $('#tbpursuppverif-tb_bf_etc').removeAttr('disabled');
    } else {
        // alert('Bidang usaha lain-lain di kunci');
        $('#tbpursuppverif-tb_bf_etc').attr('disabled','disabled');
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
// $image4 = $model->sk_menkeh && is_file(Yii::getAlias('@webroot') . $model->sk_menkeh) ? $model->sk_menkeh : '/frontend/img_static/no_photo.jpg';