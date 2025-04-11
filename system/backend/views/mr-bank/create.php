<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrBank */

$this->title = 'Create Mr Bank';
$this->params['breadcrumbs'][] = ['label' => 'Mr Banks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mr-bank-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
