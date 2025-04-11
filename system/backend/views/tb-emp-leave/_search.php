<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;
/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpLeaveSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="tb-emp-leave-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>
    <div class="row">
        <div class="col-lg-6">
            <?php
                echo '<div class="form-group ">';
                echo '<label class="control-label">Mulai Tanggal</label>';
                echo '<div class="input-group drp-container">';
                echo DatePicker::widget([
                    'name' => 'start_date',
                    'type' => DatePicker::TYPE_INPUT,
                    'value' => Yii::$app->request->get('start_date') ?: date('d/m/Y'),
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd/mm/yyyy'
                    ]
                ]); 
                echo '<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>';
                echo '</div>';
                echo '</div>';
            ?>
        </div>
        <div class="col-lg-6">
            <?php
                echo '<div class="form-group ">';
                echo '<label class="control-label">Sampai Tanggal</label>';
                echo '<div class="input-group drp-container">';
                echo DatePicker::widget([
                    'name' => 'till_date',
                    'type' => DatePicker::TYPE_INPUT,
                    'value' => Yii::$app->request->get('end_date') ?: date('d/m/Y'),
                    'pluginOptions' => [
                        'autoclose'=>true,
                        'format' => 'dd/mm/yyyy'
                    ]
                ]); 
                echo '<span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>';
                echo '</div>';
                echo '</div>';
            ?>
        </div>
    </div>

    <?php //echo $form->field($model, 'id') ?>

    <?php //echo $form->field($model, 'id_user') ?>

    <?php //echo $form->field($model, 'leave_type') ?>

    <?php //echo $form->field($model, 'start_date') ?>

    <?php //echo $form->field($model, 'till_date') ?>

    <?php // echo $form->field($model, 'reason') ?>

    <?php // echo $form->field($model, 'dof') ?>

    <?php // echo $form->field($model, 'timestamp') ?>

    <div class="col-md-12 col-md-offset-4 text-center">

    <div class="form-group">
        <?= Html::submitButton('Cari', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Ulang', ['index'], ['class' => 'btn btn-default']) ?>
    </div>

    </div>

    <?php ActiveForm::end(); ?>

</div>
