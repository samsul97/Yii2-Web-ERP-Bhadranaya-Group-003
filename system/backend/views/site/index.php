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
use yii\bootstrap4\LinkPager as Bootstrap4LinkPager;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */

$this->title = 'Bhadranaya Group Application System';
$this->params['page_title'] = 'Dashboard';
$this->params['page_desc'] = $this->title;
$this->params['title_card'] = 'Information';

// $select_level = ArrayHelper::map(UserLevel::find()->asArray()->all(), function($model, $defaultValue) {

//     return sprintf('%s', $model['code']);

// }, function($model, $defaultValue) {

//         return sprintf('%s', $model['name']);
//     }
// );
$level = Yii::$app->user->identity->level;
// var_dump($select_level == $level);
// die;

?>
<!-- USER ADMIN -->
<?php if($level == '6fb4f22992a0d164b77267fde5477248') : ?>
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
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <p>Data User</p>
                        <h3><?=Yii::$app->formatter->asInteger(User::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-users"></i>
                    </div>
                    <a href="<?=Url::to(['user/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-blue">
                    <div class="inner">
                        <p>Data Absensi</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmpAttendance::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-hourglass"></i>
                    </div>
                    <a href="<?=Url::to(['tb-emp-attendance/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-gradient-gray">
                    <div class="inner">
                        <p>Data Cuti</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmpLeave::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cut"></i>
                    </div>
                    <a href="<?=Url::to(['tb-emp-leave/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-teal">
                    <div class="inner">
                        <p>Data Kerusakan Barang</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbAssetsBroken::getCountBroken()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-trash"></i>
                    </div>
                    <a href="<?=Url::to(['tb-assets/broken']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
            </div>
        </div>
        <div class="site-index">
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Data Inventori Kantor</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbAssets::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-square"></i>
                    </div>
                    <a href="<?=Url::to(['tb-assets/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Data Inventori Bahan Baku</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbInventory::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-briefcase"></i>
                    </div>
                    <a href="<?=Url::to(['tb-inventory/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <p>Data TKP</p>
                        <h3><?=Yii::$app->formatter->asInteger(MrTkp::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-map-marker"></i>
                    </div>
                    <a href="<?=Url::to(['mr-tkp/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <p>Data Karyawan</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Status Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan Berdasarkan TKP'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrTkp::getGrafikTkpEmployee(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Pendidikan Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Assets Berdasarkan TKP'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Assets',
                  'data' => MrTkp::getGrafikTkpAssets(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
    </div>
    <div>&nbsp;</div>
    <div class="row">
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Status Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Assets Berdasarkan Kategori'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Assets',
                  'data' => MrInCategory::getGrafikCategoryAssets(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Pendidikan Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Inventory Berdasarkan Jenis'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Inventory',
                  'data' => MrInType::getGrafikTypeInventory(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
    </div>
    <!-- <div class="card-body">

        <div class="jumbotron">

            <h1>Congratulations!</h1>

            <p class="lead">You have successfully created your Yii-powered application.</p>

            <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
        
        </div>

        <div class="body-content">

            <div class="row">

                <div class="col-lg-4">

                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                </div>

                <div class="col-lg-4">

                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                </div>

                <div class="col-lg-4">

                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                
                </div>
            
            </div>

        </div>

    </div> -->
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
<?php endif ?>


<!-- USER HRD -->
<?php if($level == '2fae3af091b358426e15064175a896df') : ?>
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
          <div class="row">
              <div class="col-lg-12">
                <?php
                    $today = date('Y-m-d');                    

                    $allEmployee = TbEmployee::find()->all();

                    echo '<div class="card-body">';
                    echo '<div class="alert alert-info alert-dismissible">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    echo '<h6><i class="icon fas fa-birthday-cake"></i> Ultah Karyawan!</h6>';

                    foreach ($allEmployee as $ultah) {
                        $timestamp = strtotime($ultah->dob);
                        $date = date('m-d', $timestamp);

                        $days_laters = date('Y-m-d', strtotime('+5 days', strtotime($today)));
                        $reminderUltah = date('m-d', strtotime($days_laters));
                        
                        if ($date == $reminderUltah) {
                            echo "Halo semua, " . '<b>' . $ultah->name . '</b>' . " 5 hari Lagi Ultah Loh Pada Tanggal ". '<b>' . date_format(date_create($days_laters),"d F Y") . '</b>';
                            echo "<br>";
                        }
                    }
                    echo '</div>';
                    echo '</div>';
                ?>
                </div>
            </div>
            <div class="row">
                <div class=col-lg-12>
                <?php
                    $today = date('Y-m-d');
                    $allEmployee = TbEmployee::find()->all();
                    
                    echo '<div class="card-body">';
                    echo '<div class="alert alert-danger alert-dismissible">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    echo '<h6><i class="icon fas fa-exclamation-triangle"></i> Notifikasi Karyawan Masa Percobaan Akan Muncul Disini!</h6>';

                    foreach ($allEmployee as $employee) {
                        $notif_probation = date('Y-m-d', strtotime($today .' +1 month'));
                        if ($notif_probation == $employee->status_probation) {
                            echo "Dear HRD, " . '<b>' . $employee->name . '</b>' . " Habis Percobaan Pada Tanggal ". '<b>' . $employee->status_probation . '</b>';
                            echo '<br>';
                        }
                    }
                    echo '</div>';
                    echo '</div>';
                ?>
                <?php
                    $today = date('Y-m-d');
                    $allEmployee = TbEmployee::find()->all();
                    
                    echo '<div class="card-body">';
                    echo '<div class="alert alert-success alert-dismissible">';
                    echo '<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>';
                    echo '<h6><i class="icon fas fa-exclamation-triangle"></i> Notifikasi Karyawan Masa Kontrak Akan Muncul Disini!</h6>';

                    foreach ($allEmployee as $employee) {
                        $notif_contract = date('Y-m-d', strtotime($today .' +1 month'));
                        $notif_contract_plus5 = date('Y-m-d', strtotime($employee->status_contract .' +5 day'));
                        $datediff = strtotime($notif_contract_plus5) - strtotime($notif_contract);
                        $range = round($datediff / (60 * 60 * 24));
                        if ($range >=0 && $range <=5) {
                            echo "Dear HRD, " . '<b>' . $employee->name . '</b>' . " Habis Kontrak Pada Tanggal ". '<b>' . $employee->status_contract . '</b>';
                            echo '<br>';
                        }
                        // if ($tgl_notif == $employee->status_probation) {
                        //     echo "Dear HRD, " . '<b>' . $employee->name . '</b>' . " Akan Habis Probation Pada Tanggal ". '<b>' . $employee->status_probation . '</b>';
                        //     echo '<br>';
                        // }
                        // ============ contract ============
                        // $contract = $employee->status_contract;
                        // $diff_contract = strtotime($contract) - strtotime($join);

                        // ============ rumus contract ============
                        // $years_contract = floor($diff_contract / (365*60*60*24));
                        // $months_contract = floor(($diff_contract - $years_contract * 365*60*60*24) / (30*60*60*24));
                        // $days_contract = floor(($diff_contract - $years_contract * 365*60*60*24 - $months_contract*30*60*60*24)/ (60*60*24));

                        // ============ contract condition ============
                        // if ($years_contract == 0 && $months_contract == 0 && $days_contract == 0) {
                        //     echo
                        //     "Dear HRD, " . '<b>' . $employee->name . '</b>' . " Masa Kontraknya Habis Hari Ini";
                        //     echo '<br>';
                        // }

                        // if ($diff_contract < 0) {
                        //     echo
                        //     "Dear HRD, " . '<b>' . $employee->name . '</b>' . " Masa Kontraknya Habis Hari Ini";
                        //     echo '<br>';
                        // }

                        // if ($years_contract == 0 && $months_contract == 0 && ($days_contract <= 3 && $days_contract >= 1)) {
                        //     echo
                        //     "Dear HRD, " . '<b>' . $employee->name . '</b>' . " Masa Kontraknya Tinggal ".$days ." Hari Lagi";
                        //     echo '<br>';
                        // }


                        // ============ Probation ============
                        // $join = $employee->date_join;
                        // $probation = $employee->status_probation;
                        // $diff = strtotime($probation) - strtotime($join);

                        // ============ rumus probation ============
                        // $years = floor($diff / (365*60*60*24));
                        // $months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24));
                        // $days = floor(($diff - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
                        
                        // ============ probation condition ============
                        // if ($years == 0 && $months == 0 && $days == 0) {
                        //     echo
                        //     "Dear HRD, " . '<b>' . $employee->name . '</b>' . " Masa Probationya Habis Hari Ini";
                        //     echo '<br>';
                        // }
                        // if ($diff < 0) {
                        //     echo
                        //     "Dear HRD, " . '<b>' . $employee->name . '</b>' . " Masa Probationya Sudah Melewati Tanggal";
                        //     echo '<br>';
                        // }
                        // if ($years == 0 && $months == 0 && ($days <= 3 && $days >= 1)) {
                        //     echo
                        //     "Dear HRD, " . '<b>' . $employee->name . '</b>' . " Masa Probationya Tinggal ".$days ." Hari Lagi";
                        //     echo '<br>';
                        // }

                        // ========== Contract Where Enum ===========
                        // $join = strtotime($employee->date_join);
                        // $contract = $employee->status_contract;
                        // $get_num_month = str_replace(" Bulan", "", $contract);
                        // $finalContract = date("Y-m-d", strtotime("+" . $get_num_month . " month", $join));
                        // $days_laters = date('Y-m-d', strtotime('+5 days', strtotime($today)));
                        // $reminderProbation = date('Y-m-d', strtotime($days_laters));
                        // if ($finalContract == $reminderProbation) {
                        //     echo
                        //     "Dear HRD, " . '<b>' . $employee->name . '</b>' . " Masa Kontraknya Hampir Mau Habis Pada Tanggal  ". '<b>' . date_format(date_create($days_laters),"d F Y") . '</b>';
                        //     echo '<br>';
                        // }
                    }
                    echo '</div>';
                    echo '</div>';
                ?>
                </div>
            </div>
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Total Karyawan</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Karyawan Aktif</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Karyawan Tidak Aktif</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountNonActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <p>Administrasi</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmpAdministration::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <a href="<?=Url::to(['tb-emp-administration/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
            </div>
            <!-- <div class="row" style="margin: 3px;">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Absensi</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-hourglass"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
             </div>
             <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <p>Total Cuti</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmpLeave::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cut"></i>
                    </div>
                    <a href="<?=Url::to(['tb-emp-leave/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div> -->
        </div>
    </div>

    

    <div class="row">
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Status Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di TKP'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrTkp::getGrafikTkpEmployee(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Pendidikan Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di Perusahaan'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrCompany::getGrafikEmployeeCompany(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
    </div>
    <!-- <div class="card-body">

        <div class="jumbotron">

            <h1>Congratulations!</h1>

            <p class="lead">You have successfully created your Yii-powered application.</p>

            <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
        
        </div>

        <div class="body-content">

            <div class="row">

                <div class="col-lg-4">

                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                </div>

                <div class="col-lg-4">

                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                </div>

                <div class="col-lg-4">

                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                
                </div>
            
            </div>

        </div>

    </div> -->
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
<?php endif ?>

<!-- USER IT -->
<!-- header("refresh: 10;"); -->
<?php if($level == 'cd32106bcb6de321930cf34574ea388c') : ?>
<!-- Default box -->
<div class="card">
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
        <div class="site-index">
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Data Aset</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbAssets::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-long-arrow-alt-up"></i>
                    </div>
                    <a href="<?=Url::to(['tb-assets/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Data TKP</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbAssets::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-list"></i>
                    </div>
                    <a href="<?=Url::to(['mr-tkp/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <p>Data Inventory</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbAssets::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-wrench"></i>
                    </div>
                    <a href="<?=Url::to(['tb-inventory/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <p>Data Email</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbAssets::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-exchange-alt"></i>
                    </div>
                    <a href="<?=Url::to(['mr-email/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
            </div>
        </div>
        <div class="row">
          <?php
          $tkp = new ActiveDataProvider([
            'query' => MrTkp::find(),
            'pagination' => [
              'pagesize' => 18
            ],
          ]);
          ?>
          <?php foreach ($tkp->getModels() as $statustkp) {?> 
            <!-- Kolom box mulai -->
            <div class="col-lg-4">
              <!-- Box mulai -->
              <div class="card table-card">
                <div class="card-header">
                  <div class="user-block">
                    <?php
                    // set TLL Timeout
                    $ttl = 128;
                    $timeout = 5;
                    $host = $statustkp->ip_public;
                    
                    $ping = new \JJG\Ping($host, $ttl, $timeout);
                    $latency = $ping->ping();

                    $online = Url::base()."/dist/img/statusonline.png";
                    $offline = Url::base()."/dist/img/statusoffline.png";
                    if ($latency !== false) {
                      echo "<img class='img-circle' src='$online' alt='Status'>";
                    } else {
                      echo "<img class='img-circle' src='$offline' alt='Status'>";
                    }
                    ?>
                    <span class="username"><?= Html::a($statustkp->name, ['mr-tkp/view', 'id' => $statustkp->id]); ?></span>
                    <span class="description"><?= $statustkp->responbilities; ?></span>
                  </div>
                  <div class="card-tools">
                    <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
                    <i class="fas fa-minus"></i></button>
                    <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
                    <i class="fas fa-expand"></i></button>
                  </div>
                </div>
                <div class="card-body">
                  <!-- <img class="card-img-top" style="height: 50px;"> -->
                    <?=Highcharts::widget([
                          'options' => [
                            // 'credits' => false,
                            'time' => [
                              'useUTC' => false,
                            ],
                            'legend' => [
                              'enabled' => false,
                            ],
                            
                            // 'title' => ['text' => 'Assets Berdasarkan TKP'],
                            'exporting' => ['enabled' => true],
                            'plotOptions' => [
                                'pie' => [
                                'cursor' => 'pointer',
                                ],
                            ],
                            'series' => [
                                [
                                'type' => 'spline',
                                'name' => 'Assets',
                                'data' => MrTkp::getGrafikTkpAssets(),
                                ],
                            ],
                          ],
                      ]);?>
                  <!-- </img> -->
                  <!-- <img class="card-img-top" style="height: 100px;" src="<?= Url::base().'/dist/img/statistics.png'?>" alt="Photo"> -->
                  <p>Alamat : <?= substr($statustkp->alamat,0,40);?></p>
                  <p>No HP PIC : <?= $statustkp->no_hp;?></p>
                  <p>Telp : <?= $statustkp->telp;?></p>
                  <p>IP : <?= $statustkp->ip_public;?></p>
                  <?= Html::a("<i class='fa fa-eye'> Detail TKP</i>",["mr-tkp/view","id"=>$statustkp->id],['class' => 'btn btn-default']) ?>
                </div>
              </div>
              <!-- Box selesai -->
            </div>
            <!-- Kolom box selesai -->  
          <?php
            }
          ?>
    </div>
      <div class="row">
        <center>
          <?= Bootstrap4LinkPager::widget([
            'pagination' => $tkp->pagination,
          ]); ?>
        </center>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->


<?php endif ?>

<!-- USER MAINTENANCE -->
<?php if($level == '30afc70c60d9adc29581e3e12b662f70') : ?>
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
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Total Barang</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbAssets::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-boxes"></i>
                    </div>
                    <a href="<?=Url::to(['tb-assets/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Total Barang Rusak</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbAssetsBroken::getCountBroken()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-recycle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-assets/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-purple">
                    <div class="inner">
                        <p>Total Barang Dijual</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbAssetsBroken::getCountSale()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-shopping-cart"></i>
                    </div>
                    <a href="<?=Url::to(['tb-assets/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                    <div class="inner">
                        <p>Total Barang Dibuang</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbAssetsBroken::getCountWaste()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-trash"></i>
                    </div>
                    <a href="<?=Url::to(['tb-assets/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="box-header with-border">
                    <!-- <center><h4 class="box-title">Pendidikan Karyawan</h4></center> -->
                    </div>
                    <div class="box-body">
                    <?=Highcharts::widget([
                        'options' => [
                        'credits' => false,
                        'title' => ['text' => 'Assets Berdasarkan TKP'],
                        'exporting' => ['enabled' => true],
                        'plotOptions' => [
                            'pie' => [
                            'cursor' => 'pointer',
                            ],
                        ],
                        'series' => [
                            [
                            'type' => 'pie',
                            'name' => 'Assets',
                            'data' => MrTkp::getGrafikTkpAssets(),
                            ],
                        ],
                        ],
                    ]);?>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="box-header with-border">
                    <!-- <center><h4 class="box-title">Status Karyawan</h4></center> -->
                    </div>
                    <div class="box-body">
                    <?=Highcharts::widget([
                        'options' => [
                        'credits' => false,
                        'title' => ['text' => 'Assets Berdasarkan Kategori'],
                        'exporting' => ['enabled' => true],
                        'plotOptions' => [
                            'pie' => [
                            'cursor' => 'pointer',
                            ],
                        ],
                        'series' => [
                            [
                            'type' => 'pie',
                            'name' => 'Assets',
                            'data' => MrInCategory::getGrafikCategoryAssets(),
                            ],
                        ],
                        ],
                    ]);?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

    <?php 
    // $datas = TbAssets::find()->all();
    
    // foreach ($datas as $key => $data) {
    //             $elementId = 'showBarcode' . '-' . $data['sku'];
	// 			$value = $data['sku'];
	// 			$type = 'code39';
	// 			BarcodeGenerator::widget(array('elementId' => $elementId, 'value' => $value, 'type' => $type));
	// 			echo '<div id="showBarcode-'.$data['sku'].'"></div>';
    // } 
    ?>
    </div>
    <!-- <div class="card-body">

        <div class="jumbotron">

            <h1>Congratulations!</h1>

            <p class="lead">You have successfully created your Yii-powered application.</p>

            <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
        
        </div>

        <div class="body-content">

            <div class="row">

                <div class="col-lg-4">

                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
                </div>

                <div class="col-lg-4">

                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
                </div>

                <div class="col-lg-4">

                    <h2>Heading</h2>

                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                        dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                        ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                        fugiat nulla pariatur.</p>

                    <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
                
                </div>
            
            </div>

        </div>

    </div> -->
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
<?php endif ?>


<!-- USER OPERASIONAL -->
<?php if($level == '76f74a94597f51a32c4ffd1c588ade8d') : ?>
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
            <div class="row">
                OPERASIONAL CONTENT 1
            </div>
            <div class="row">
                OPERASIONAL CONTENT 2
            </div>
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Total Produk</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Total Produk</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Total Produk</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountNonActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <p>Total Produk</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmpAdministration::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <a href="<?=Url::to(['tb-emp-administration/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
            </div>
            <!-- <div class="row" style="margin: 3px;">
            <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Absensi</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-hourglass"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
             </div>
             <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-green">
                    <div class="inner">
                        <p>Total Cuti</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmpLeave::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-cut"></i>
                    </div>
                    <a href="<?=Url::to(['tb-emp-leave/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
              </div>
            </div> -->
        </div>
    </div>

    

    <div class="row">
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Status Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di TKP'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrTkp::getGrafikTkpEmployee(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Pendidikan Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di Perusahaan'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrCompany::getGrafikEmployeeCompany(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
<?php endif ?>


<!-- USER MARKETING -->
<?php if($level == '6f32664cc1e92b2f3b5c126e367ff190') : ?>
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="site-index">
            <div class="row">
                MARKETING CONTENT 1
            </div>
            <div class="row">
                MARKETING CONTENT 2
            </div>
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Total Pelanggan</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Total Iklan</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Total Voucher</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountNonActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-purple">
                    <div class="inner">
                        <p>Total Artikel</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmpAdministration::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <a href="<?=Url::to(['tb-emp-administration/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
            </div>
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-olive">
                        <div class="inner">
                            <p>Total Promo Diskon</p>
                            <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCount()); ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-hourglass"></i>
                        </div>
                        <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-green">
                        <div class="inner">
                            <p>Total Program</p>
                            <h3><?=Yii::$app->formatter->asInteger(TbEmpLeave::getCount()); ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-cut"></i>
                        </div>
                        <a href="<?=Url::to(['tb-emp-leave/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                </div>
            </div>
        </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Status Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di TKP'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrTkp::getGrafikTkpEmployee(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Pendidikan Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di Perusahaan'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrCompany::getGrafikEmployeeCompany(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
<?php endif ?>



<!-- USER PURCHASING -->
<?php if($level == '0fe808a4a397918a63827606c08b8461') : ?>
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="site-index">
            <div class="row">
                PURCHASING CONTENT 1
            </div>
            <div class="row">
                PURCHASING CONTENT 2
            </div>
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Total Supplier</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Barang Masuk</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Barang Keluar</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountNonActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <p>Total Artikel</p>
                            <h3><?=Yii::$app->formatter->asInteger(TbEmpAdministration::getCount()); ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <a href="<?=Url::to(['tb-emp-administration/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Status Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di TKP'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrTkp::getGrafikTkpEmployee(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Pendidikan Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di Perusahaan'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrCompany::getGrafikEmployeeCompany(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
<?php endif ?>



<!-- USER COSTCONTROL -->
<?php if($level == '4e31467b1a352aca7d982411cefd2cc1') : ?>
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="site-index">
            <div class="row">
                COSTCONTROL CONTENT 1
            </div>
            <div class="row">
                COSTCONTROL CONTENT 2
            </div>
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Total Supplier</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Barang Masuk</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Barang Keluar</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountNonActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <p>Barang Ditolak</p>
                            <h3><?=Yii::$app->formatter->asInteger(TbEmpAdministration::getCount()); ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <a href="<?=Url::to(['tb-emp-administration/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Status Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di TKP'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrTkp::getGrafikTkpEmployee(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Pendidikan Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di Perusahaan'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrCompany::getGrafikEmployeeCompany(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
<?php endif ?>




<!-- USER FINANCE -->
<?php if($level == '4e31467b1a352aca7d982411cefd2cc1') : ?>
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="site-index">
            <div class="row">
                COSTCONTROL CONTENT 1
            </div>
            <div class="row">
                COSTCONTROL CONTENT 2
            </div>
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Total Supplier</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Barang Masuk</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Barang Keluar</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountNonActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <p>Barang Ditolak</p>
                            <h3><?=Yii::$app->formatter->asInteger(TbEmpAdministration::getCount()); ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <a href="<?=Url::to(['tb-emp-administration/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Status Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di TKP'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrTkp::getGrafikTkpEmployee(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Pendidikan Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di Perusahaan'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrCompany::getGrafikEmployeeCompany(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
<?php endif ?>


<!-- USER KARYAWAN -->
<?php if($level == '4e31467b1a352aca7d982411cefd2cc1') : ?>
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="site-index">
            <div class="row">
                COSTCONTROL CONTENT 1
            </div>
            <div class="row">
                COSTCONTROL CONTENT 2
            </div>
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Total Supplier</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Barang Masuk</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Barang Keluar</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountNonActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <p>Barang Ditolak</p>
                            <h3><?=Yii::$app->formatter->asInteger(TbEmpAdministration::getCount()); ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <a href="<?=Url::to(['tb-emp-administration/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Status Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di TKP'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrTkp::getGrafikTkpEmployee(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Pendidikan Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di Perusahaan'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrCompany::getGrafikEmployeeCompany(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
<?php endif ?>



<!-- USER TKP -->
<?php if($level == '4e31467b1a352aca7d982411cefd2cc1') : ?>
<!-- Default box -->
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><?= Html::encode($this->title) ?></h3>
        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" data-toggle="tooltip" title="Collapse">
            <i class="fas fa-minus"></i></button>
            <button type="button" class="btn btn-tool" data-card-widget="maximize" data-toggle="tooltip" title="Maximize">
            <i class="fas fa-expand"></i></button>
        </div>
    </div>
    <div class="card-body">
        <div class="site-index">
            <div class="row">
                COSTCONTROL CONTENT 1
            </div>
            <div class="row">
                COSTCONTROL CONTENT 2
            </div>
            <div class="row" style="margin: 3px;">
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Total Supplier</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCount()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-orange">
                    <div class="inner">
                        <p>Barang Masuk</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                <div class="small-box bg-olive">
                    <div class="inner">
                        <p>Barang Keluar</p>
                        <h3><?=Yii::$app->formatter->asInteger(TbEmployee::getCountNonActive()); ?></h3>
                    </div>
                    <div class="icon">
                        <i class="fa fa-user-circle"></i>
                    </div>
                    <a href="<?=Url::to(['tb-employee/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
                </div>
                <div class="col-lg-3 col-xs-6">
                    <div class="small-box bg-purple">
                        <div class="inner">
                            <p>Barang Ditolak</p>
                            <h3><?=Yii::$app->formatter->asInteger(TbEmpAdministration::getCount()); ?></h3>
                        </div>
                        <div class="icon">
                            <i class="fa fa-envelope"></i>
                        </div>
                        <a href="<?=Url::to(['tb-emp-administration/index']); ?>" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

    <div class="row">
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Status Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di TKP'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrTkp::getGrafikTkpEmployee(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
      <div class="col-sm-6">
        <div class="box-header with-border">
          <!-- <center><h4 class="box-title">Pendidikan Karyawan</h4></center> -->
        </div>
        <div class="box-body">
          <?=Highcharts::widget([
            'options' => [
              'credits' => false,
              'title' => ['text' => 'Karyawan di Perusahaan'],
              'exporting' => ['enabled' => true],
              'plotOptions' => [
                'pie' => [
                  'cursor' => 'pointer',
                ],
              ],
              'series' => [
                [
                  'type' => 'pie',
                  'name' => 'Karyawan',
                  'data' => MrCompany::getGrafikEmployeeCompany(),
                ],
              ],
            ],
          ]);?>
        </div>
      </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="text-center"><i><?= Html::encode($this->title) ?></i></div>
    </div>
    <!-- /.card-footer-->
</div>
<!-- /.card -->
<?php endif ?>

