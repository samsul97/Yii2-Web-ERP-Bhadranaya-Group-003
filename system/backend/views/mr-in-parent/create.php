<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrInParent */

$this->title = 'Create Mr In Parent';
$this->params['breadcrumbs'][] = ['label' => 'Mr In Parents', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mr-in-parent-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
