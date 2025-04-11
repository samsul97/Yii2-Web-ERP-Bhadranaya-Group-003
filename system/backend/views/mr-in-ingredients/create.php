<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrInIngredients */

$this->title = 'Create Mr In Ingredients';
$this->params['breadcrumbs'][] = ['label' => 'Mr In Ingredients', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mr-in-ingredients-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
