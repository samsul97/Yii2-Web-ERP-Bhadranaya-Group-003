<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbInvManagement */

$this->title = 'Create Tb Inv Management';
$this->params['breadcrumbs'][] = ['label' => 'Tb Inv Managements', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-inv-management-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
