<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeHeader */

$this->title = 'Create Set Fe Header';
$this->params['breadcrumbs'][] = ['label' => 'Set Fe Headers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="set-fe-header-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
