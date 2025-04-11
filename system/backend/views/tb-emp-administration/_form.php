<?php

use backend\models\MrCompany;
use backend\models\MrDivision;
use backend\models\MrEmpLetter;
use backend\models\MrTkp;
use backend\models\TbEmpAdministration;
use backend\models\TbEmployee;
use kartik\date\DatePicker;
use kartik\number\NumberControl;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\BaseStringHelper;
use yii\helpers\Url;

$code_digit  = 3;
$code_prefix = '';
$code_model  = TbEmpAdministration::find()->select(['no_letter'])->orderBy(['id' => SORT_DESC, 'no_letter' => SORT_DESC])->asArray()->one();
$code_init   = (int) BaseStringHelper::byteSubstr($code_model['no_letter'], strlen($code_prefix), strlen($code_prefix) + $code_digit);
$code_no    = str_pad($code_init + 1 , $code_digit, '0', STR_PAD_LEFT);

$select_employee = ArrayHelper::map(TbEmployee::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['nie']. ' - ' . $model['name'];
}
);

$select_letter = ArrayHelper::map(MrEmpLetter::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_company = ArrayHelper::map(MrCompany::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_tkp = ArrayHelper::map(MrTkp::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_department = ArrayHelper::map(MrDivision::find()->select(['department_name'])->distinct()->asArray()->all(), function($model, $defaultValue) {
    return $model['department_name'];
}, 'department_name'
);

$select_position1 = $model->isNewRecord ? array() : ArrayHelper::map(MrDivision::find()->select(['position_name'])->where(['department_name' => $model->department])->distinct()->asArray()->all(), function($model, $defaultValue) {
    return $model['position_name'];
}, 'position_name'
);

$select_division = ArrayHelper::map(MrDivision::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['department_name'];
}
);

$select_position = ArrayHelper::map(MrDivision::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['position_name'];
}
);




/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpAdministration */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-emp-administration-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
        <?= Html::label('Karyawan', 'employee', ['class' => 'control-label']) ?>
            <?= Select2::widget([
                'id' => 'employee',
                'name' => 'employee',
                'data' => $select_employee,
                'value' => 0,
                'options' => [
                    'placeholder' => 'Pilih Karyawan',
                    'onChange' => '$.post("'.Url::base().'/tb-emp-administration/select?id='.'" + $(this).val(), function(data) {
                            what = JSON.parse(data);
                            $("#sm_position").val(what.sm_position);
                            $("#sm_division").val(what.sm_division);
                            $("#dm_position").val(what.dm_position);
                            $("#pr_position").val(what.pr_position);
                            $("#act_position").val(what.act_position);
                            $("#division").val(what.division);
                            $("#salary").val(what.salary);
                            $("#company").val(what.company);
                            $("#tkp").val(what.tkp);
                        }
                    );',
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]) ?>
            <?= $form->field($model, 'id_letter', ['inputOptions'=>['id'=>'surat-select2']])->widget(Select2::classname(),[
                    'data' => $select_letter,
                    'options' => [
                        'placeholder' => 'Pilih Jenis Surat',
                        'value' => $model->isNewRecord ? 0 : $model->id_letter,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>

            <div id="surat_mutasi" style="display: none">
                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'sm_old_boss')->textInput(['placeholder' => 'Atasan Lama']) ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'sm_new_boss')->textInput(['placeholder' => 'Atasan Baru']) ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <?= Html::label('Divisi Lama', 'sm_division', ['class' => 'control-label']) ?>
                        <input type="text" class="form-control" value="<?= $employees ?>" name="sm_division" id="sm_division" readonly="true">
                    </div>                
                    <div class="col-lg-6">
                        <?= Html::label('Jabatan Lama', 'sm_position', ['class' => 'control-label']) ?>
                        <input type="text" class="form-control" value="<?= $employees ?>" name="sm_position" id="sm_position" readonly="true">
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <?= $form->field($model, 'sm_new_division')->widget(Select2::classname(),[
                            'data' => $select_department,
                            'options' => [
                                'placeholder' => 'Pilih Departemen',
                                'onChange' => '$.post("'.Url::base().'/reff/divisionmutasi?type=D&name='.'" + $(this).val(), function(data) {
                                    what = JSON.parse(data);
                                    $("#tbempadministration-sm_new_position").html(what.sm_new_position);
                                }
                                );',
                            ],
                            'pluginOptions' => [
                                'allowClear' => false
                            ],
                        ]);
                        ?>
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'sm_new_position')->widget(Select2::classname(),[
                            'data' => $select_position1,
                            'options' => [
                                'placeholder' => 'Pilih Jabatan',
                            ],
                            'pluginOptions' => [
                                'allowClear' => false
                            ],
                        ]);
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <?= Html::label('Perusahaan Lama', 'company', ['class' => 'control-label']) ?>
                        <input type="text" class="form-control" value="<?= $employees ?>" name="company" id="company" readonly="true">
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'sm_new_company')->widget(Select2::classname(),[
                            'data' => $select_company,
                            'options' => [
                                'placeholder' => 'Pilih Perusahaan',
                                'value' => $model->isNewRecord ? 0 : $model->sm_new_company,
                            ],
                            'pluginOptions' => [
                                'allowClear' => false
                            ],
                        ]);
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <?= Html::label('Lokasi Kerja Sebelumnya', 'tkp', ['class' => 'control-label']) ?>
                        <input type="text" class="form-control" value="<?= $employees ?>" name="tkp" id="tkp" readonly="true">
                    </div>
                    <div class="col-lg-6">
                        <?= $form->field($model, 'sm_new_tkp')->widget(Select2::classname(),[
                            'data' => $select_tkp,
                            'options' => [
                                'placeholder' => 'Pilih Outlet',
                                'value' => $model->isNewRecord ? 0 : $model->sm_new_tkp,
                            ],
                            'pluginOptions' => [
                                'allowClear' => false
                            ],
                        ]);
                        ?>
                    </div>
                </div>
            </div>

            <div id="surat_demosi" style="display: none">
                
                <?= Html::label('Jabatan Lama', 'dm_position', ['class' => 'control-label']) ?>
                <input type="text" class="form-control" value="<?= $employees ?>" name="dm_position" id="dm_position" readonly="true">
                
                <?= $form->field($model, 'dm_new_position')->widget(Select2::classname(),[
                    'data' => $select_position,
                    'options' => [
                        'placeholder' => 'Pilih Jabatan',
                        'value' => $model->isNewRecord ? 0 : $model->dm_new_position,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
                ?>

            </div>

            <div id="surat_promosi" style="display: none">
                
                <?= Html::label('Jabatan Lama', 'pr_position', ['class' => 'control-label']) ?>
                <input type="text" class="form-control" value="<?= $employees ?>" name="pr_position" id="pr_position" readonly="true">
                
                <?= $form->field($model, 'pr_new_position')->widget(Select2::classname(),[
                    'data' => $select_position,
                    'options' => [
                        'placeholder' => 'Pilih Jabatan',
                        'value' => $model->isNewRecord ? 0 : $model->pr_new_position,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
                ?>
                
                <?= Html::label('Gaji Lama', 'salary', ['class' => 'control-label']) ?>
                <input type="text" class="form-control" value="<?= $employees ?>" name="salary" id="salary" readonly="true">
                
                <?= $form->field($model, 'pr_new_salary')->widget(NumberControl::classname(), [
                    'data' => 'number-decimal',
                    'displayOptions' => [
                        'placeholder' => 'Gaji Sekarang',
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

            <div id="surat_acting" style="display: none">
                <?= Html::label('Jabatan Lama', 'act_position', ['class' => 'control-label']) ?>
                <input type="text" class="form-control" value="<?= $employees ?>" name="act_position" id="act_position" readonly="true">
                
                <?= $form->field($model, 'act_new_position')->widget(Select2::classname(),[
                    'data' => $select_position,
                    'options' => [
                        'placeholder' => 'Pilih Jabatan',
                        'value' => $model->isNewRecord ? 0 : $model->act_new_position,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
                ?>

                <?= $form->field($model, 'act_date')->widget(DatePicker::classname(), [
                        'options' => [
                            'placeholder'  => 'Tanggal Efektif',
                            'autocomplete' => 'off',
                            'value' => $model->isNewRecord ? date('Y-m-d') : $model->act_date,
                        ],
                        'pluginOptions' => [
                            'autoclose'      => true,
                            'todayHighlight' => true,
                            'format'         => 'yyyy-mm-dd'
                        ]
                    ])
                ?>
                
                <?= $form->field($model, 'act_date_expired')->widget(DatePicker::classname(), [
                        'options' => [
                            'placeholder'  => 'Berlaku Hingga',
                            'autocomplete' => 'off',
                            'value' => $model->isNewRecord ? date('Y-m-d') : $model->act_date_expired,
                        ],
                        'pluginOptions' => [
                            'autoclose'      => true,
                            'todayHighlight' => true,
                            'format'         => 'yyyy-mm-dd'
                        ]
                    ])
                ?>
            
            </div>

            </div>

            <div class="col-lg-6">
            <?= $form->field($model, 'contents')->textarea(['rows' => 6, 'placeholder' => 'Isi Surat']) ?>

            <?php echo $form->field($model, 'year')->widget(etsoft\widgets\YearSelectbox::classname(), [
                'yearStart' => 0,
                'yearEnd' => -20,
            ]);
            ?>

            <?= $form->field($model, 'no_letter')->textInput(['placeholder' => 'No Surat', 'readonly' => true, 'value' => $model->isNewRecord ? $code_no : $model->no_letter]) ?>

            <?= $form->field($model, 'no_month')->widget(Select2::classname(),[
                    'data' => [ 'I' => 'I', 'II' => 'II', 'III' => 'III', 'IV' => 'IV', 'V' => 'V', 'VI' => 'VI', 'VII' => 'VII', 'VIII' => 'VIII', 'IX' => 'IX', 'X' => 'X', 'XI' => 'XI', 'XII' => 'XII', ],
                    'options' => [
                        'placeholder' => 'Pilih Bulan Romawi',
                        'value' => $model->isNewRecord ? 'M' : $model->no_month,
                    ],
                    'pluginOptions' => [
                        'allowClear' => false
                    ],
                ]);
            ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Kembali', ['index'], ['class' => 'btn btn-warning']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<?php
$js = <<< JS
$('#surat-select2').on('change', function (e) {
    let data = $(this).val();
    // alert(data);
    $("#surat_mutasi").hide();
    $("#surat_demosi").hide();
    $("#surat_promosi").hide();
    $("#surat_acting").hide();
    if(data == 4) {
        $("#surat_mutasi").show();
        $("#surat_demosi").hide();
        $("#surat_promosi").hide();
        $("#surat_acting").hide();
    } else if(data == 5) {
        $("#surat_mutasi").hide();
        $("#surat_demosi").show();
        $("#surat_promosi").hide();
        $("#surat_acting").hide();
    } else if(data == 7) {
        $("#surat_mutasi").hide();
        $("#surat_demosi").hide();
        $("#surat_promosi").show();
        $("#surat_acting").hide();
    } else if(data == 8) {
        $("#surat_mutasi").hide();
        $("#surat_demosi").hide();
        $("#surat_promosi").hide();
        $("#surat_acting").show();
    }
});
JS;

$this->registerJs($js);