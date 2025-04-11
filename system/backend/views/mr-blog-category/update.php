<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrBlogCategory */

$this->title = 'Update Mr Blog Category: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Mr Blog Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mr-blog-category-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
