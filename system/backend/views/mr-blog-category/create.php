<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrBlogCategory */

$this->title = 'Create Mr Blog Category';
$this->params['breadcrumbs'][] = ['label' => 'Mr Blog Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mr-blog-category-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
