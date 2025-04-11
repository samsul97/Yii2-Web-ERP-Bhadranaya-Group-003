<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\SetFeChat */

$this->title = 'Update Set Fe Chat: ' . $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Set Fe Chats', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="set-fe-chat-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
