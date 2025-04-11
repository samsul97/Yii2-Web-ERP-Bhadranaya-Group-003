<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbOps */

$this->title = 'Create Tb Ops';
$this->params['breadcrumbs'][] = ['label' => 'Tb Ops', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-ops-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
