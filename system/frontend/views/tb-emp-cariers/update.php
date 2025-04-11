<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TbEmpCariers */

$this->title = 'Update Tb Emp Cariers: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Tb Emp Cariers', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="tb-emp-cariers-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
