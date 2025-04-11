<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetBeNavMenu */

$this->title = 'Update Set Be Nav Menu: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Set Be Nav Menus', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="set-be-nav-menu-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
