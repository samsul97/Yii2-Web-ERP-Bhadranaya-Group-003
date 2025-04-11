<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpCalender */

$this->title = 'Create Tb Emp Calender';
$this->params['breadcrumbs'][] = ['label' => 'Tb Emp Calenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-emp-calender-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
