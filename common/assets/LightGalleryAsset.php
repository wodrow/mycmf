<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-7-6
 * Time: 下午4:22
 */

namespace common\assets;


use yii\web\AssetBundle;

class LightGalleryAsset extends AssetBundle
{
    public $sourcePath = '@bower/lightgallery';
    public $css = [
        'dist/css/lg-transitions.min.css',
        'dist/css/lightgallery.min.css'
    ];
    public $js = [
        'dist/js/lightgallery-all.min.js',
    ];
    public $depends = [
        'yii\web\JqueryAsset',
    ];
}