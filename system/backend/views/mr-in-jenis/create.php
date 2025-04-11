<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrInJenis */

$this->title = 'Create Mr In Jenis';
$this->params['breadcrumbs'][] = ['label' => 'Mr In Jenis', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mr-in-jenis-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
