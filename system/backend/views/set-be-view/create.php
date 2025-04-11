<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetBeView */

$this->title = 'Create Set Be View';
$this->params['breadcrumbs'][] = ['label' => 'Set Be Views', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="set-be-view-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
