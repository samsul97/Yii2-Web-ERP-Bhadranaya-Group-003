<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeFooter3Help */

$this->title = 'Create Set Fe Footer3 Help';
$this->params['breadcrumbs'][] = ['label' => 'Set Fe Footer3 Helps', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="set-fe-footer3-help-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
