<?php

use backend\models\MrBank;
use backend\models\MrCompany;
use backend\models\MrDivision;
use backend\models\MrTkp;
use yii\helpers\Html;
// use yii\widgets\ActiveForm;
use yii\helpers\Url;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use backend\models\MrLocation;
use backend\models\TbEmployee;
use yii\helpers\BaseStringHelper;
use kartik\number\NumberControl;
use kartik\form\ActiveForm;
// use shaqman\widgets\inlinescript\InlineScript;

$select_province = ArrayHelper::map(MrLocation::find()->select(['province_name'])->distinct()->asArray()->all(), function($model, $defaultValue) {
    return $model['province_name'];
}, 'province_name'
);

$select_city = $model->isNewRecord ? array() : ArrayHelper::map(MrLocation::find()->select(['city_name'])->where(['province_name' => $model->province])->distinct()->asArray()->all(), function($model, $defaultValue) {
    return $model['city_name'];
}, 'city_name'
);

$select_district = $model->isNewRecord ? array() : ArrayHelper::map(MrLocation::find()->select(['district_name'])->where(['city_name' => $model->city])->distinct()->asArray()->all(), function($model, $defaultValue) {
    return $model['district_name'];
}, 'district_name'
);

$select_department = ArrayHelper::map(MrDivision::find()->select(['department_name'])->distinct()->asArray()->all(), function($model, $defaultValue) {
    return $model['department_name'];
}, 'department_name'
);

$select_position = $model->isNewRecord ? array() : ArrayHelper::map(MrDivision::find()->select(['position_name'])->where(['department_name' => $model->department])->distinct()->asArray()->all(), function($model, $defaultValue) {
    return $model['position_name'];
}, 'position_name'
);

$select_tkp = ArrayHelper::map(MrTkp::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_company = ArrayHelper::map(MrCompany::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_bank = ArrayHelper::map(MrBank::find()->asArray()->all(), 'id', function($model, $defaultValue) {
    return $model['name'];
}
);

$code_digit  = 7;
$code_prefix = '';
$code_model  = TbEmployee::find()->select(['nie'])->orderBy(['id' => SORT_DESC, 'nie' => SORT_DESC])->asArray()->one();
$code_init   = (int) BaseStringHelper::byteSubstr($code_model['nie'], strlen($code_prefix), strlen($code_prefix) + $code_digit);
$code_nie    = str_pad($code_init + 1 , $code_digit, '0', STR_PAD_LEFT);

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmployee */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-3">
            <?php
                $image = $model->image && is_file(Yii::getAlias('@webroot') . $model->image) ? $model->image : '/images/no_photo.jpg';
            ?>
            <?= $form->field($model, 'image', [
                    'template' => '
                    {label}
                    <div id="preview">
                    <img id="img-preview" src="'. Url::base() . $image .'" alt="user image" />
                    </div>
                    {input}
                    {error}',
                ])->fileInput(['accept' => 'image/*'])
            ?>

            <?= $form->field($model, 'name')->textInput(['maxlength' => true, 'placeholder' => 'Nama Karyawan']) ?>

            <?= $form->field($model, 'nik')->textInput(['maxlength' => true, 'placeholder' => 'Wajib di isi 16 digit angka']) ?>

            <?= $form->field($model, 'npwp')->textInput(['maxlength' => true, 'placeholder' => '15 digit angka/Kosongkan jika tidak ada']) ?>

            <?= $form->field($model, 'gender')->widget(Select2::classname(),[
                    'data' => [ 'LAKI' => 'LAKI-LAKI', 'PEREMPUAN' => 'PEREMPUAN', ],
                    'options' => [
                        'placeholder' => 'Pilih Jenis Kelamin',
                        'value' => $model->isNewRecord ? 'LAKI' : $model->gender,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'pob')->textInput(['maxlength' => true, 'placeholder' => 'Tempat Lahir']) ?>

            <?= $form->field($model, 'dob')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Pilih Tanggal Lahir',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->dob,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ]) ?>
            
        </div>

        <div class="col-lg-3">

            <?= $form->field($model, 'national')->widget(Select2::classname(),[
                    'data' => [ 'WNI' => 'WNI', 'WNA' => 'WNA', ],
                    'options' => [
                        'placeholder' => 'Pilih Kewarganegaraan',
                        'value' => $model->isNewRecord ? 'WNI' : $model->national,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
            
            <?= $form->field($model, 'religion')->widget(Select2::classname(),[
                        'data' => [ 'Islam' => 'ISLAM', 'Kristen' => 'KRISTEN', 'Hindu' => 'HINDU', 'Budha' => 'BUDHA', 'Konghucu' => 'KONGHUCU', 'Katolik' => 'KATOLIK', 'Lain-lain' => 'LAIN-LAIN'],
                        'options' => [
                            'placeholder' => 'Pilih Agama',
                            'value' => $model->isNewRecord ? 'Islam' : $model->religion,
                        ],
                        'pluginOptions' => [
                            'allowClear' => false
                        ],
                    ]);
            ?>
            
            <?= $form->field($model, 'education')->widget(Select2::classname(),[
                    'data' => [ 'SMA/SMK' => 'SMA/SMK', 'D1' => 'D1', 'D3' => 'D3', 'S1' => 'S1', 'S2' => 'S2', 'S3' => 'S3', ],
                    'options' => [
                        'placeholder' => 'Pilih Pendidikan Terakhir',
                        'value' => $model->isNewRecord ? 'SMA/SMK' : $model->education,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
            
            <?= $form->field($model, 'married_status')->widget(Select2::classname(),[
                    'data' => [ 'BELUM KAWIN' => 'BELUM KAWIN', 'KAWIN' => 'KAWIN', 'KAWIN ANAK SATU' => 'KAWIN ANAK SATU', 'KAWIN ANAK DUA' => 'KAWIN ANAK DUA', 'KAWIN ANAK TIGA' => 'KAWIN ANAK TIGA'],
                    'options' => [
                        'placeholder' => 'Pilih Status Kawin',
                        'value' => $model->isNewRecord ? 'BELUM KAWIN' : $model->married_status,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'handphone')->textInput(['maxlength' => true, 'placeholder' => 'Nomor Handphone']) ?>

            <?= $form->field($model, 'telp')->textInput(['maxlength' => true, 'placeholder' => 'Nomor Rumah/Kosongkan jika tidak ada']) ?>

            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'placeholder' => 'Email Aktif']) ?>

            
            <?= $form->field($model, 'id_bank')->widget(Select2::classname(),[
                    'data' => $select_bank,
                    'options' => [
                        'placeholder' => 'Pilih BANK',
                        'value' => $model->isNewRecord ? 1 : $model->id_bank,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>


            <?= $form->field($model, 'account_number')->textInput(['maxlength' => true, 'placeholder' => 'No Rekening Aktif']) ?>

        </div>

        <div class="col-lg-3">

            <?= $form->field($model, 'sor')->widget(Select2::classname(),[
                    'data' => [ 'Rumah Orang Tua' => 'RUMAH ORANG TUA', 'Rumah Sendiri' => 'RUMAH SENDIRI', 'Kos' => 'KOS', 'Kontrak' => 'KONTRAK', ],
                    'options' => [
                        'placeholder' => 'Pilih Status Tempat Tinggal',
                        'value' => $model->isNewRecord ? 'Rumah Orang Tua' : $model->sor,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'address')->textarea(['rows' => 6, 'placeholder' => 'Alamat Lengkap']) ?>

            <?= $form->field($model, 'province')->widget(Select2::classname(),[
                    'data' => $select_province,
                    'options' => [
                        'placeholder' => 'Pilih Provinsi',
                        'onChange' => '$.post("'.Url::base().'/reff/location?type=P&name='.'" + $(this).val(), function(data) {
                                what = JSON.parse(data);
                                $("#tbemployee-city").html(what.city);
                                $("#tbemployee-district").html(null);
                            }
                        );',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'city')->widget(Select2::classname(),[
                    'data' => $select_city,
                    'options' => [
                        'placeholder' => 'Pilih Kota / Kabupaten',
                        'onChange' => '$.post("'.Url::base().'/reff/location?type=C&name='.'" + $(this).val(), function(data) {
                                what = JSON.parse(data);
                                $("#tbemployee-district").html(what.district);
                            }
                        );',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'district')->widget(Select2::classname(),[
                    'data' => $select_district,
                    'options' => [
                        'placeholder' => 'Pilih Kecamatan',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'postcode')->textInput(['maxlength' => true, 'placeholder' => 'Wajib 5 digit angka']) ?>

            

        </div>

        <div class="col-lg-3">

        <?= $form->field($model, 'nie')->textInput(['maxlength' => true, 'readonly' => false, 'value' => $model->isNewRecord ? $code_nie : $model->nie]) ?>

            <?= $form->field($model, 'date_join')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Pilih Tanggal Bergabung',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->date_join,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ]) ?>
            
            <?= $form->field($model, 'id_company')->widget(Select2::classname(),[
                    'data' => $select_company,
                    'options' => [
                        'placeholder' => 'Pilih Perusahaan',
                        'value' => $model->isNewRecord ? 1 : $model->id_company,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <?= $form->field($model, 'id_tkp')->widget(Select2::classname(),[
                    'data' => $select_tkp,
                    'options' => [
                        'placeholder' => 'Pilih Lokasi Kerja',
                        'value' => $model->isNewRecord ? 0 : $model->id_tkp,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
            
            <?= $form->field($model, 'status', ['inputOptions'=>['id'=>'status-select2']])->widget(Select2::classname(),[
                    'data' => [ 'Permanent' => 'TETAP', 'Contract' => 'KONTRAK', 'Probation' => 'PERCOBAAN', 'Resign' => 'BERHENTI', 'Blacklist' => 'DAFTAR HITAM'],
                    'options' => [
                        'placeholder' => 'Pilih Status',
                        'value' => $model->isNewRecord ? 'Permanent' : $model->status,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
            
            <div id="status_contract" style="display: none">
            <?= $form->field($model, 'status_contract')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Lama Kontrak',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->status_contract,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ]) ?>
            </div>
            
            <div id="status_probation" style="display: none">
            <?= $form->field($model, 'status_probation')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Lama Percobaan',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->status_probation,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ]) ?>
            </div>
            
            <div id="status_resign_reason" style="display: none">
                <?= $form->field($model, 'date_resign')->widget(DatePicker::classname(), [
                    'options' => [
                        'placeholder'  => 'Pilih Tanggal Keluar',
                        'autocomplete' => 'off',
                        'value' => $model->date_resign,
                    ],
                    'pluginOptions' => [
                        'autoclose'      => true,
                        'todayHighlight' => true,
                        'format'         => 'yyyy-mm-dd'
                    ]
                ]) ?>
                <?= $form->field($model, 'status_resign_reason')->textarea(['rows' => 6, 'placeholder' => 'Alasan Berhenti']) ?>
            </div>
            
            <?= $form->field($model, 'department')->widget(Select2::classname(),[
                    'data' => $select_department,
                    'options' => [
                        'placeholder' => 'Pilih Departemen',
                        'onChange' => '$.post("'.Url::base().'/reff/division?type=D&name='.'" + $(this).val(), function(data) {
                                what = JSON.parse(data);
                                $("#tbemployee-position").html(what.position);
                            }
                        );',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
            
            <?= $form->field($model, 'position')->widget(Select2::classname(),[
                    'data' => $select_position,
                    'options' => [
                        'placeholder' => 'Pilih Jabatan',
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
            
            <?= $form->field($model, 'salary')->widget(NumberControl::classname(), [
                'data' => 'number-decimal',
                'displayOptions' => [
                    'placeholder' => 'Gaji Pokok',
                ],
                'maskedInputOptions' => [
                    'digits' => 0,
                    'alias' => 'numeric',
                    'groupSeparator' => '.',
                    'autoGroup' => true,
                    'autoUnmask' => true,
                    'unmaskAsNumber' => true,
                ],
            ]); ?>

            
            <!-- <div id="fac_tk_nominal" style="display: none"> -->
                
            <!-- </div> -->
            
            <!-- <div id="fac_tj_nominal" style="display: none"> -->
                
            <!-- </div> -->
            
            <!-- <div id="fac_tbk_nominal" style="display: none"> -->
                
            <!-- </div> -->

            <?= $form->field($model, 'other_information')->textInput(['maxlength' => true, 'placeholder' => 'Ket. Tambahan (boleh dikosongkan)']) ?>
        
        </div>
    
    </div>

    <hr style="border-top: 2px double #337ab7">

    <div class="row">
        <div class="col-lg-3">
            <?= $form->field($model, 'facilities')->checkboxList([
                'Tunjangan Jabatan' => 'Tunjangan Jabatan',  // fac_tj_nominal
                'Tunjangan Komunikasi' => 'Tunjangan Komunikasi', // fac_tk_nominal
                'Tunjangan BPJS Kesehatan' => 'Tunjangan BPJS Kesehatan', // fac_tbk_nominal
                'BPJS Ketenagakerjaan' => 'BPJS Ketenagakerjaan', 
                'BPJS Kesehatan' => 'BPJS Kesehatan', 
        ], ['custom' => true, 'id' => 'custom-checkbox-list']) 
        ?>
        </div>
        
        <div class="col-lg-3">
        <?= $form->field($model, 'fac_tj_nominal')->widget(NumberControl::classname(), [
            'data' => 'number-decimal',
            'displayOptions' => [
                'placeholder' => 'Masukan Nominal Tunjangan Jabatan',
            ],
            'maskedInputOptions' => [
                'digits' => 0,
                'alias' => 'numeric',
                'groupSeparator' => '.',
                'autoGroup' => true,
                'autoUnmask' => true,
                'unmaskAsNumber' => true,
            ],
        ]); ?>
        </div>
        <div class="col-lg-3">
            <?= $form->field($model, 'fac_tk_nominal')->widget(NumberControl::classname(), [
            'data' => 'number-decimal',
            'displayOptions' => [
                'placeholder' => 'Masukan Nominal Tunjangan Komunikasi',
            ],
            'maskedInputOptions' => [
                'digits' => 0,
                'alias' => 'numeric',
                'groupSeparator' => '.',
                'autoGroup' => true,
                'autoUnmask' => true,
                'unmaskAsNumber' => true,
            ],
            ]); ?>                
        </div>
        <div class="col-lg-3">
        <?= $form->field($model, 'fac_tbk_nominal')->widget(NumberControl::classname(), [
            'data' => 'number-decimal',
            'displayOptions' => [
                'placeholder' => 'Masukan Nominal Tunjangan BPJS Kesehatan',
            ],
            'maskedInputOptions' => [
                'digits' => 0,
                'alias' => 'numeric',
                'groupSeparator' => '.',
                'autoGroup' => true,
                'autoUnmask' => true,
                'unmaskAsNumber' => true,
            ],
        ]); ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
                <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
                <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-warning']) ?>
            </div>
        </div>  
    </div>

    <?php ActiveForm::end(); ?>

</div>

<!-- Function For Checkbox Facilities -->
<?php // InlineScript::begin(); ?>
    <!-- <script>
        $('#tbemployee-facilities').on('change', function (e) {
            data = $('#tbemployee-facilities :checkbox:checked').val();
            // alert($(this).val());
            $("#fac_tk_nominal").hide();
            $("#fac_tj_nominal").hide();
            $("#fac_tbk_nominal").hide();
            if(data == '1') {
                $("#fac_tj_nominal").show();
                $("#fac_tk_nominal").hide();
                $("#fac_tbk_nominal").hide();
            } if(data == '2') {
                $("#fac_tj_nominal").hide();
                $("#fac_tk_nominal").show();
                $("#fac_tbk_nominal").hide();
            } if(data == '5') {
                $("#fac_tj_nominal").hide();
                $("#fac_tk_nominal").hide();
                $("#fac_tbk_nominal").show();
            }
        });
    </script> -->
<?php // InlineScript::end(); ?>

<?php
$js = <<< JS
// Function For Employee Status
$('#status-select2').on('change', function (e) {
    let data = $(this).val();
    $("#status_contract").hide();
    $("#status_probation").hide();
    $("#status_resign_reason").hide();
    if(data === 'Contract') {
        $("#status_contract").show();
        $("#status_probation").hide();
        $("#status_resign_reason").hide();
    } else if(data === 'Probation') {
        $("#status_probation").show();
        $("#status_contract").hide();
        $("#status_resign_reason").hide();
    } else if(data === 'Resign') {
        $("#status_probation").hide();
        $("#status_contract").hide();
        $("#status_resign_reason").show();
    }
});

// $('#tbemployee-facilities').on('change', function(e){
//     xval = $('#tbemployee-facilities :checkbox:checked').val();
//     if (xval == '1') {
//         $('#tbemployee-fac_tj_nominal').attr('type','input');
//         $('#tbemployee-fac_tj_nominal').val('');
//     }
//     if (xval == '2') {
//         $('#tbemployee-fac_tk_nominal').attr('type','input');
//         $('#tbemployee-fac_tk_nominal').val('');
//     }
//     if (xval== '5') {
//         $('#tbemployee-fac_tbk_nominal').attr('type','input');
//         $('#tbemployee-fac_tbk_nominal').val('');
//     } else {

//         $('#tbemployee-facilities').attr('type','hidden');

//         // $('#tbemployee-fac_tj_nominal').attr('type','hidden');
//         // $('#tbemployee-fac_tk_nominal').attr('type','hidden');
//         // $('#tbemployee-fac_tbk_nominal').attr('type','hidden');

//     }
//     $('#tbemployee-facilities').focus();
// });



$('#tbemployee-image').on('change', function(e) {
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