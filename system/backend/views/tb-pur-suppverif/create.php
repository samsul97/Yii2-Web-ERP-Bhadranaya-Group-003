<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbPurSuppverif */

$this->title = 'Create Tb Pur Suppverif';
$this->params['breadcrumbs'][] = ['label' => 'Tb Pur Suppverifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-pur-suppverif-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
