<?php

use yii\helpers\Html;
use yii\grid\GridView;
use kartik\tabs\TabsX;
use yii\helpers\Url;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SetBeViewSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Set Be Views';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="card table-card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="card-text">
            <div class="set-fe-header-index">
                <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
                <?php
                    echo TabsX::widget([
                        'position' => TabsX::POS_ABOVE,
                        'align' => TabsX::ALIGN_LEFT,
                        'items' => [
                            [
                                'label' => 'Template',
                                'linkOptions'=>['data-url'=> Url::to(['set-be-view/update?id=1'])],
                                'content' => '',
                                'active' => true
                            ],

                            [
                                'label' => 'Menu Navbar',
                                'content' => '',
                                'linkOptions'=>['data-url'=> Url::to(['set-be-nav-menu/index'])],
                                'headerOptions' => ['style'=>'font-weight:bold'],
                            ],
                        ],
                    ]);
                ?>
            </div>
        </div>
    </div>
</div>
