<?php

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * Main frontend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@wroot';

    public $baseUrl = '@wurl';

    public $css = [
        'css/site.css',
    ];

    public $js = [
    ];

//    public $jsOptions = [
//        'position' => \yii\web\View::POS_HEAD
//    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'yii\bootstrap\BootstrapThemeAsset',
        'yii\bootstrap\BootstrapPluginAsset',
//        'colee\vue\VueAsset',
//        'common\components\assets\Gojs',
//        'common\components\assets\ThreeJs',
        'kartik\icons\FontAwesomeAsset',
    ];
}
