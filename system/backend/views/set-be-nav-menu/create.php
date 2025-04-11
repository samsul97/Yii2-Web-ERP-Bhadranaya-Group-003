<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetBeNavMenu */

$this->title = 'Create Set Be Nav Menu';
$this->params['breadcrumbs'][] = ['label' => 'Set Be Nav Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="set-be-nav-menu-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
