<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Tbemptkpops */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tbemptkpops-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'no_receipt')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'id_tkp_from')->textInput() ?>

    <?= $form->field($model, 'id_tkp_destination')->textInput() ?>

    <?= $form->field($model, 'id_user')->textInput() ?>

    <?= $form->field($model, 'pic')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'necessity')->dropDownList([ 'Order Barang' => 'Order Barang', 'Lintas Divisi' => 'Lintas Divisi', 'Reject' => 'Reject', 'Barang Yang Tidak di Order' => 'Barang Yang Tidak di Order', 'Transfer Barang' => 'Transfer Barang', 'Dll' => 'Dll', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'note')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'deadline')->textInput() ?>

    <?= $form->field($model, 'created_at')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
