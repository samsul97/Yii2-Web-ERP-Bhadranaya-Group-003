<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetBeView */

$this->title = 'Update Set Be View: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Set Be Views', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="set-be-view-update">
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
