<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TbEmpCariers */

$this->title = 'Create Tb Emp Cariers';
$this->params['breadcrumbs'][] = ['label' => 'Tb Emp Cariers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-emp-cariers-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
