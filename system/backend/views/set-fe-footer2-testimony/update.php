<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeFooter2Testimony */

$this->title = 'Update Set Fe Footer2 Testimony: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Set Fe Footer2 Testimonies', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="set-fe-footer2-testimony-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
