<?php

use backend\models\MrCompany;
use backend\models\MrInCategory;
use backend\models\MrInType;
use backend\models\MrTkp;
use backend\models\TbAssets;
use backend\models\TbAssetsBroken;
use backend\models\TbEmpAdministration;
use backend\models\TbEmpAttendance;
use backend\models\TbEmpLeave;
use backend\models\TbEmpLoan;
use backend\models\TbEmployee;
use backend\models\TbInventory;
use backend\models\User;
use yii\helpers\Url;
use yii\helpers\Html;
use miloschuman\highcharts\Highcharts;
use yii\helpers\ArrayHelper;
use yii\widgets\LinkPager;
use barcode\barcode\BarcodeGenerator;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */

$this->title = 'CCTV Monitoring';
$this->params['page_title'] = 'CCTV Monitoring';
$this->params['page_desc'] = $this->title;
$this->params['title_card'] = 'Information';

$level = Yii::$app->user->identity->level;

?>
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
            <!-- <button type="button" class="btn btn-tool" data-card-widget="remove" data-toggle="tooltip" title="Remove">
            <i class="fas fa-times"></i></button> -->
        </div>
    </div>
    <div class="card-body">
        <div class="site-index">
            CCTV Monitoring On Progress
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->