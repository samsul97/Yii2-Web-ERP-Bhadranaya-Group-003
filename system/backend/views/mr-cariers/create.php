<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrCariers */

$this->title = 'Create Mr Cariers';
$this->params['breadcrumbs'][] = ['label' => 'Mr Cariers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mr-cariers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
