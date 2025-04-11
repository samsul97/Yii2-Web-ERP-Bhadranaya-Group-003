<?php

use backend\models\MrTkp;
use backend\models\Tbinvpoparent;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;
use yii\helpers\BaseStringHelper;

$select_tkp = ArrayHelper::map(MrTkp::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);


// CODE PO INDUK (PO+001)
$code_digit  = 3;
$code_prefix = 'PO';
$code_model  = Tbinvpoparent::find()->where(['LIKE', 'purchase_number_parent', $code_prefix])->max('purchase_number_parent');
$code_init   = (int) BaseStringHelper::byteSubstr($code_model, strlen($code_prefix), strlen($code_prefix) + $code_digit);
$code_seq    = str_pad($code_init + 1 , $code_digit, '0', STR_PAD_LEFT);
$code_po = $code_prefix . $code_seq;


// CODE PO TRANSACTION (TANGGAL+PO+001)
$code_digits  = 2;
$code_tgl    = date('dmY');
$code_prefixs = 'PO';
$code_models  = Tbinvpoparent::find()->where(['LIKE', 'no_transaction', $code_prefixs])->max('no_transaction');
$code_inits   = (int) BaseStringHelper::byteSubstr($code_models, strlen($code_prefixs), strlen($code_prefixs) + $code_digits);
$code_seqs    = str_pad($code_inits + 1 , $code_digits, '0', STR_PAD_LEFT);
$code_transaction = $code_tgl. $code_prefixs . $code_seqs;

// CODE PO ANAK (PO+NAMATKP+001)
$code_digits  = 2;
$code_tgl    = date('dmY');
$code_prefixs = 'PO';
$code_models  = Tbinvpoparent::find()->where(['LIKE', 'no_transaction', $code_prefixs])->max('no_transaction');
$code_inits   = (int) BaseStringHelper::byteSubstr($code_models, strlen($code_prefixs), strlen($code_prefixs) + $code_digits);
$code_seqs    = str_pad($code_inits + 1 , $code_digits, '0', STR_PAD_LEFT);
$code_transaction = $code_tgl. $code_prefixs . $code_seqs;

/* @var $this yii\web\View */
/* @var $model backend\models\Tbinvpoparent */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbinvpoparent-form">

    <?php $form = ActiveForm::begin(['id' => 'dynamic-form']); ?>

    <div class="row">
        <div class="col-sm-6"> 
            <?= $form->field($modelParent, 'no_transaction')->textInput(['maxlength' => true, 'readonly' => true, 'value' => $modelParent->isNewRecord ? $code_transaction : $modelParent->code_transaction]) ?>
        </div>
        <div class="col-sm-6">
            <?= $form->field($modelParent, 'purchase_number_parent')->textInput(['maxlength' => true, 'readonly' => true, 'value' => $modelParent->isNewRecord ? $code_po : $modelParent->code_po]) ?>    
        </div>
    </div>

    <div class="padding-v-md">
        <div class="line line-dashed"></div>
    </div>

    <?php DynamicFormWidget::begin([
        'widgetContainer' => 'dynamicform_wrapper',
        'widgetBody' => '.container-items',
        'widgetItem' => '.house-item',
        'limit' => 10,
        'min' => 1,
        'insertButton' => '.add-house',
        'deleteButton' => '.remove-house',
        'model' => $modelsChild[0],
        'formId' => 'dynamic-form',
        'formFields' => [
            'purchase_number_child',
            'id_tkp',
        ],
    ]); ?>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>OUTLET</th>
                <th style="width: 450px;">ITEMS</th>
                <th class="text-center" style="width: 90px;">
                    <button type="button" class="add-house btn btn-success btn-sm"><span class="fa fa-plus"></span></button>
                </th>
            </tr>
        </thead>
        <tbody class="container-items">
        <?php foreach ($modelsChild as $indexHouse => $modelHouse): ?>
            <tr class="house-item">
                <td class="vcenter">
                    <?php
                        // necessary for update action.
                        if (! $modelHouse->isNewRecord) {
                            echo Html::activeHiddenInput($modelHouse, "[{$indexHouse}]id");
                        }
                    ?>
                    <?= $form->field($modelHouse, "[{$indexHouse}]id_tkp")->label(false)->widget(Select2::classname(),[
                            'data' => $select_tkp,
                            'options' => [
                                'placeholder' => 'Pilih Lokasi Pengiriman',
                                'value' => $modelHouse->isNewRecord ? 0 : $modelHouse->id_tkp,
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                        ]);
                    ?>
                    <?= $form->field($modelHouse, "[{$indexHouse}]purchase_number_child")->label(false)->textInput(['maxlength' => true, 'readonly' => true, 'value' => $modelParent->isNewRecord ? $code_po : $modelParent->code_po]) ?>
                </td>
                <td>
                    <?= $this->render('_form-invs', [
                        'form' => $form,
                        'indexHouse' => $indexHouse,
                        'modelsRoom' => $modelsInv[$indexHouse],
                    ]) ?>
                </td>
                <td class="text-center vcenter" style="width: 90px;">
                    <button type="button" class="remove-house btn btn-danger btn-sm"><span class="fa fa-minus"></span></button>
                </td>
            </tr>
         <?php endforeach; ?>
        </tbody>
    </table>

    <?php DynamicFormWidget::end(); ?>
    
    
    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
