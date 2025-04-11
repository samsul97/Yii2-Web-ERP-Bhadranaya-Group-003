<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpPayroll */

$this->title = 'Create Tb Emp Payroll';
$this->params['breadcrumbs'][] = ['label' => 'Tb Emp Payrolls', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-emp-payroll-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
