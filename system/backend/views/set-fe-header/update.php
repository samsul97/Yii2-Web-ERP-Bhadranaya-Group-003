<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeHeader */

$this->title = 'Update Set Fe Header: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Set Fe Headers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="set-fe-header-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
