<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrBusinessfields */

$this->title = 'Create Mr Businessfields';
$this->params['breadcrumbs'][] = ['label' => 'Mr Businessfields', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mr-businessfields-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
