<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrBusinessfields */

$this->title = 'Update Mr Businessfields: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mr Businessfields', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mr-businessfields-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
