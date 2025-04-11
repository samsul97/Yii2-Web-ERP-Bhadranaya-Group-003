<?php

use backend\models\TbEmployee;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
use kartik\date\DatePicker;
use yii\helpers\Url;
// use shaqman\widgets\inlinescript\InlineScript;

$select_employee = ArrayHelper::map(TbEmployee::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['nie']. ' - ' . $model['name'];
}
);



/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpLeave */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-emp-leave-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-lg-6">
            <?= Html::label('Karyawan', 'employee', ['class' => 'control-label']) ?>
            <?= Select2::widget([
                'id' => 'employee',
                'name' => 'employee',
                'data' => $select_employee,
                'value' => $model,
                'options' => [
                    'placeholder' => 'Pilih Karyawan',
                    'onChange' => '$.post("'.Url::base().'/tb-emp-leave/select?id='.'" + $(this).val(), function(data) {
                            what = JSON.parse(data);
                            $("#leave_off_employee").val(what.leave_off_employee);
                        }
                    );',
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]) ?>
            
            <?= Html::label('Sisa Cuti Tahun Ini', 'leave_off_employee', ['class' => 'control-label']) ?>
            <input type="text" class="form-control" value="<?= $employees ?>" name="leave_off_employee" id="leave_off_employee" readonly="true">

            <?= $form->field($model, 'leave_type', ['inputOptions' =>['id' =>'leave_types']])->widget(Select2::classname(),[
                'data' => [ 'Tahunan' => 'TAHUNAN', 'Khusus' => 'KHUSUS', ],
                'options' => [
                    'placeholder' => 'Pilih Jenis Cuti',
                    'value' => $model->isNewRecord ? 'Tahunan' : $model->leave_type,
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]);
            ?>
            
            <div id="leave_type_special" style="display: none">
            <?= $form->field($model, 'leave_type_special')->widget(Select2::classname(),[
                'data' => [ 'Melahirkan' => 'MELAHIRKAN', 'Hamil' => 'HAMIL', 'Menikah' => 'MENIKAH', 'Alasan Penting' => 'ALASAN PENTING', ],
                'options' => [
                    'placeholder' => 'Pilih Cuti Khusus',
                    'value' => $model->leave_type_special,
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]);
            ?>
            </div>

            <?= $form->field($model, 'start_date')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Pilih Tanggal Lahir',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->start_date,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ])
            ?>
            <?= $form->field($model, 'till_date')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Pilih Tanggal Lahir',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->till_date,
                ],
                'pluginOptions' => [
                    'autoclose'      => true,
                    'todayHighlight' => true,
                    'format'         => 'yyyy-mm-dd'
                ]
            ])
            ?>
        </div>
        <div class="col-lg-6">
            <?= $form->field($model, 'reason')->textArea(['maxlength' => true, 'rows' =>6]) ?>            
            
            <?= $form->field($model, 'dof')->widget(DatePicker::classname(), [
                'options' => [
                    'placeholder'  => 'Pilih Tanggal Pengajuan',
                    'autocomplete' => 'off',
                    'value' => $model->isNewRecord ? date('Y-m-d') : $model->dof,
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

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>

<?php
$js = <<< JS
$('#leave_types').on('change', function (e) {
    let data = $(this).val();
    $("#leave_type_special").hide();
    if(data === 'Khusus') {
        $("#leave_type_special").show();
    }
});
JS;

$css = <<< CSS

CSS;

$this->registerJs($js);
$this->registerCss($css);