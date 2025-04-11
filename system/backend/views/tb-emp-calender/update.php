<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpCalender */

$this->title = 'Update Tb Emp Calender: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Tb Emp Calenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-emp-calender-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
