<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\select2\Select2;
// use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $model backend\models\TbAssets */
/* @var $form yii\widgets\ActiveForm */

?>

<div class="tb-assets-form">
    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'condition_issue')->textarea(['rows' => 6, 'placeholder' => 'Deskripsi Kerusakan Barang']) ?>
        <?= $form->field($model, 'status')->widget(Select2::classname(),[
                'data' => [ 'Progress' => 'PROGRESS', 'Pending' => 'PENDING', 'Done' => 'DONE', ],
                'options' => [
                    'placeholder' => 'Pilih Status',
                    'value' => $model->isNewRecord ? 'Progress' : $model->status,
                ],
                'pluginOptions' => [
                    'allowClear' => false
                ],
            ]);
        ?>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
            <?= Html::a('Cancel', ['index'], ['class' => 'btn btn-warning']) ?>
        </div>
    <?php ActiveForm::end(); ?>
</div>
