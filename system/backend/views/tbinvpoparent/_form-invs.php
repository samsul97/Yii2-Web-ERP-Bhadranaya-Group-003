<?php

use backend\models\MrInUnit;
use backend\models\TbInventory;
use backend\models\TbPurSupplier;
use yii\helpers\Html;
use wbraganca\dynamicform\DynamicFormWidget;
use yii\helpers\ArrayHelper;
use kartik\select2\Select2;

$select_item = ArrayHelper::map(TbInventory::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['desc'];
}
);

$select_unit = ArrayHelper::map(MrInUnit::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

$select_supplier = ArrayHelper::map(TbPurSupplier::find()->asArray()->all(), 'id', function($model, $defaultValue){
    return $model['name'];
}
);

?>

<?php DynamicFormWidget::begin([
    'widgetContainer' => 'dynamicform_inner',
    'widgetBody' => '.container-rooms',
    'widgetItem' => '.room-item',
    'limit' => 4,
    'min' => 1,
    'insertButton' => '.add-room',
    'deleteButton' => '.remove-room',
    'model' => $modelsRoom[0],
    'formId' => 'dynamic-form',
    'formFields' => [
        'name'
    ],
]); ?>
<table class="table table-bordered">
    <thead>
        <tr>
            <th>ITEM</th>
            <th class="text-center">
                <button type="button" class="add-room btn btn-success btn-xs"><span class="fa fa-plus"></span></button>
            </th>
        </tr>
    </thead>
    <tbody class="container-rooms">
    <?php foreach ($modelsRoom as $indexRoom => $modelRoom): ?>
        <tr class="room-item">
            <td class="vcenter">
                <?php
                    // necessary for update action.
                    if (! $modelRoom->isNewRecord) {
                        echo Html::activeHiddenInput($modelRoom, "[{$indexHouse}][{$indexRoom}]id");
                    }
                ?>
                <div class="row">
                    <div class="col-sm-6">
                        <?= $form->field($modelRoom, "[{$indexHouse}][{$indexRoom}]id_pur_supplier")->label(false)->widget(Select2::classname(),[
                            'data' => $select_supplier,
                            'options' => [
                                'placeholder' => 'Pilih Supplier',
                                'value' => $modelRoom->isNewRecord ? 0 : $modelRoom->id_pur_supplier,
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            ]);
                        ?>
                        <?= $form->field($modelRoom, "[{$indexHouse}][{$indexRoom}]qty")->label(false)->textInput(['maxlength' => true, 'placeholder' => 'Qty', 'type' => 'number', 'min' => 0, 'value' => $modelRoom->isNewRecord ? $modelRoom->qty : null]) ?>
                    </div>
                    <div class="col-sm-6">
                        <?= $form->field($modelRoom, "[{$indexHouse}][{$indexRoom}]id_inv")->label(false)->widget(Select2::classname(),[
                            'data' => $select_item,
                            'options' => [
                                'placeholder' => 'Pilih Item',
                                'value' => $modelRoom->isNewRecord ? 0 : $modelRoom->id_inv,
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            ]);
                        ?>
                        <?= $form->field($modelRoom, "[{$indexHouse}][{$indexRoom}]id_in_unit")->label(false)->widget(Select2::classname(),[
                            'data' => $select_unit,
                            'options' => [
                                'placeholder' => 'Pilih Unit',
                                'value' => $modelRoom->isNewRecord ? 0 : $modelRoom->id_in_unit,
                            ],
                            'pluginOptions' => [
                                'allowClear' => true
                            ],
                            ]);
                        ?>
                    </div>
                </div>
            </td>
            <td class="text-center vcenter" style="width: 90px;">
                <button type="button" class="remove-room btn btn-danger btn-xs"><span class="fa fa-minus"></span></button>
            </td>
        </tr>
     <?php endforeach; ?>
    </tbody>
</table>
<?php DynamicFormWidget::end(); ?>