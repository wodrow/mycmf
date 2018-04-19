<?php

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * Main backend application asset bundle.
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@wroot/backend';
    public $baseUrl = '@wurl/backend';
    public $css = [
//        'css/site.css',
    ];
    public $js = [
    ];
    public $depends = [
//        'yii\web\YiiAsset',
//        'yii\bootstrap\BootstrapAsset',
//        'dee\adminlte\AdminlteAsset',
        'dmstr\web\AdminLteAsset',
    ];
}
