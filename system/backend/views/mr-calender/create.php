<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\MrCalender */

$this->title = 'Create Mr Calender';
$this->params['breadcrumbs'][] = ['label' => 'Mr Calenders', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="mr-calender-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
