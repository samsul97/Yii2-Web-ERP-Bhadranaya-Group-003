<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\TbPurSuppverif */

$this->title = 'Vendor Registration Form';
$this->params['breadcrumbs'][] = ['label' => 'Tb Pur Suppverifs', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tb-pur-suppverif-create">
    
    <center><h2 class="card-title"><?= Html::encode($this->title) ?></h2></center>
    <?php //echo Html::img('@web/system/frontend/web/image/bhadranaya.jpg', ['class' => 'pull-center img-responsive']); ?>
    
    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>
    
    <div class="container">
        <img src="<?= Yii::getAlias('@web').'/frontend/img_static/bhadranaya.png' ?>" style="width: 100%; height:auto; display: block; margin: 0">
    </div>

</div>
