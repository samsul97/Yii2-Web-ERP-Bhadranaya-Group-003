<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrCalender */

$this->title = 'Update Mr Calender: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mr Calenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mr-calender-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
