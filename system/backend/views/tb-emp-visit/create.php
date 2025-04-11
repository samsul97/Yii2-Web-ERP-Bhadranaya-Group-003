<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbEmpVisit */

$this->title = 'Create Tb Emp Visit';
$this->params['breadcrumbs'][] = ['label' => 'Tb Emp Visits', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-emp-visit-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
