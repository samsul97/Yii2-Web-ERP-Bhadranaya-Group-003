<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrInCategory */

$this->title = 'Create Mr In Category';
$this->params['breadcrumbs'][] = ['label' => 'Mr In Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mr-in-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
