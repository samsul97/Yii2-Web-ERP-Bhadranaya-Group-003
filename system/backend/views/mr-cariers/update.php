<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrCariers */

$this->title = 'Update Mr Cariers: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Mr Cariers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="mr-cariers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
