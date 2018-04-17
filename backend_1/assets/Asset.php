<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-11
 * Time: 下午4:59
 */

namespace backend_1\assets;


use yii\web\AssetBundle;

class Asset extends AssetBundle
{
    public $baseUrl = '@wurl/backend_1';
    public $basePath = '@wroot/backend_1';

    public $css = [
        '//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap.min.css',
        '//cdn.bootcss.com/bootstrap/3.3.5/css/bootstrap-theme.min.css',
//        'css/font-awesome.min.css',
        '//cdn.bootcss.com/animate.css/3.5.2/animate.min.css',
        '//cdn.bootcss.com/iCheck/1.0.2/skins/all.css',
        '//cdn.bootcss.com/metisMenu/1.1.3/metisMenu.min.css',
        '//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.css',
//        'css/animate.min.css',
        'css/style.min.css',
//        'css/login.min.css',
    ];

    public $js = [
//        '//cdn.bootcss.com/jquery/3.3.1/core.js',
//        '//cdn.bootcss.com/jquery/3.3.1/jquery.min.js',
        '//cdn.bootcss.com/jquery/2.1.4/jquery.min.js',
//        '//cdn.bootcss.com/jquery/3.3.1/jquery.slim.min.js',
        '//cdn.bootcss.com/bootstrap/3.3.5/js/bootstrap.min.js',
//        '//cdn.bootcss.com/bootstrap/3.3.5/js/npm.js',
        '//cdn.bootcss.com/iCheck/1.0.2/icheck.min.js',
        '//cdn.bootcss.com/metisMenu/1.1.3/metisMenu.min.js',
        '//cdn.bootcss.com/pace/0.5.1/pace.min.js',
        '//cdn.bootcss.com/jQuery-slimScroll/1.3.0/jquery.slimscroll.min.js',
        '//cdn.bootcss.com/sweetalert/1.1.3/sweetalert.min.js',
        'js/layer/layer.js',
        'js/contabs.min.js',
//        'js/hplus.min.js',
        '//cdn.bootcss.com/html2canvas/0.4.1/html2canvas.min.js',
        'js/rageframe.js',
        'js/template.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'colee\vue\VueAsset',
        'kartik\icons\FontAwesomeAsset',
    ];

    public $jsOptions = [
//        'position' => \yii\web\View::POS_HEAD,
    ];
}