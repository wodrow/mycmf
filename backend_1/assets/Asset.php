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

    public $css = [
        'css/font-awesome.min.css',
        'css/animate.min.css',
        'css/style.min.css',
        'css/login.min.css',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}