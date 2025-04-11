<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrInIngredients */

$this->title = 'Update Mr In Ingredients: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mr In Ingredients', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mr-in-ingredients-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
