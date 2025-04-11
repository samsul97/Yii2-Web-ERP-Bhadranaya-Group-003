<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'frontend/css/site.css',
        "//fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700",
        "frontend/plugins/overlayScrollbars/css/OverlayScrollbars.min.css",
        "frontend/plugins/sweetalert2/sweetalert2.css",
        // "//code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css",
        // 'frontend/css/webapps.css',
        // "plugins/fontawesome-free/css/all.min.css",
        // "dist/css/adminlte.min.css",
    ];
    public $js = [
        "frontend/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js",
        "frontend/plugins/sweetalert2/sweetalert2.all.js",
        // "frontend/js/adminlte.min.js",
        // "frontend/js/demo.js",
    ];
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap4\BootstrapAsset',
    ];
}
