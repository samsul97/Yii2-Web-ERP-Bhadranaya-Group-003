<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\TbInvManagement */

$this->params['breadcrumbs'][] = ['label' => 'Inventory', 'url' => ['index']];
?>
<div class="card table-card">
    <div class="card-body">
        <div class="card-text">
            <div class="tb-inv-management-update">
                <?= $this->render('ainput_management', [
                    'inv_management' => $inv_management,
                    'select_inv' => $select_inv,
                    // 'wasinput' => $wasinput,
                    'check_inventory' => $check_inventory,
                ]) ?>
            </div>
        </div>
    </div>
</div>
