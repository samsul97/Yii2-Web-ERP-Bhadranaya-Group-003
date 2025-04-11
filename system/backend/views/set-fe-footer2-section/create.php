<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeFooter2Section */

$this->title = 'Create Set Fe Footer2 Section';
$this->params['breadcrumbs'][] = ['label' => 'Set Fe Footer2 Sections', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="set-fe-footer2-section-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
