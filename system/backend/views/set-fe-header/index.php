<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\Url;
use kartik\tabs\TabsX;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\SetFeHeaderSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Frontend View';
$this->params['breadcrumbs'][] = $this->title;

// $header = Url::to(['set-fe-header/update']);
// $section = Url::to(['set-fe-footer2-section/update']);
// $testimony = Url::to(['set-fe-footer2-testimony/update']);
// $about = Url::to(['set-fe-footer3-about/update']);
// $help = Url::to(['set-fe-footer3-help/update']);
// $sosmed = Url::to(['set-fe-footer3-sosmed/update']);
// $chat = Url::to(['set-fe-footer3-chat/update']);
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
                <?php
                    echo TabsX::widget([
                        'position' => TabsX::POS_ABOVE,
                        'align' => TabsX::ALIGN_LEFT,
                        'items' => [
                            [
                                'label' => 'Header',
                                'linkOptions'=>['data-url'=> Url::to(['set-fe-header/update?id=1'])],
                                'content' => '',
                                'active' => true
                            ],
                            [
                                'label' => 'Section',
                                'items' => [
                                    [
                                        'label' => 'Testimony',
                                        'content' => '',
                                        'linkOptions'=>['data-enable-cache'=>true, 'data-url'=> Url::to(['set-fe-footer2-testimony/index'])],
                                        // 'headerOptions' => ['style'=>'font-weight:bold'],
                                        // 'options' => ['id' => 'myveryownID'],
                                    ],
                                    [
                                        'label' => 'Section',
                                        'content' => '',
                                        'linkOptions'=>['data-url'=> Url::to(['set-fe-footer2-section/update?id=1'])],
                                        // 'headerOptions' => ['style'=>'font-weight:bold'],
                                        // 'options' => ['id' => 'myveryownID'],
                                    ],
                                ],
                            ],
                            [
                                'label' => 'Footer',
                                'items' => [
                                    [
                                        'label' => 'Sosmed',
                                        'content' => '',
                                        'linkOptions'=>['data-enable-cache'=>true, 'data-url'=> Url::to(['set-fe-footer3-sosmed/index'])],
                                        // 'headerOptions' => ['style'=>'font-weight:bold'],
                                        // 'options' => ['id' => 'myveryownID'],
                                    ],
                                    [
                                        'label' => 'Help',
                                        'content' => '',
                                        'linkOptions'=>['data-enable-cache'=>true, 'data-url'=> Url::to(['set-fe-footer3-help/index'])],
                                        // 'headerOptions' => ['style'=>'font-weight:bold'],
                                        // 'options' => ['id' => 'myveryownID'],
                                    ],
                                    [
                                        'label' => 'About',
                                        'content' => '',
                                        'linkOptions'=>['data-url'=> Url::to(['set-fe-footer3-about/update?id=1'])],
                                        // 'headerOptions' => ['style'=>'font-weight:bold'],
                                        // 'options' => ['id' => 'myveryownID'],
                                    ],
                                ],
                            ],

                            [
                                'label' => 'Chat',
                                'content' => '',
                                'linkOptions'=>['data-url'=> Url::to(['set-fe-chat/update?id=1'])],
                                // 'headerOptions' => ['style'=>'font-weight:bold'],
                                // 'options' => ['id' => 'myveryownID'],
                            ],
                        ],
                    ]);
                ?>
            </div>
        </div>
    </div>
</div>