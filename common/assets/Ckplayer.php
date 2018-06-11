<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-6-11
 * Time: 下午3:47
 */

namespace common\assets;


use yii\web\AssetBundle;

class Ckplayer extends AssetBundle
{
    public $basePath = "@wroot/js/ckplayer";
    public $baseUrl = "@wurl/js/ckplayer";
    public $js = [
        'ckplayer/ckplayer.js',
    ];
}