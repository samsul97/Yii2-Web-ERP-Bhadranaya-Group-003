<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrInCategory */

$this->title = 'Update Mr In Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mr In Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mr-in-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
