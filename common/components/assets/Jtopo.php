<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/19/17
 * Time: 3:50 PM
 */

namespace common\components\assets;


use yii\web\AssetBundle;

class Jtopo extends AssetBundle
{
    public $css = [
        "http://www.jtopo.com/css/jquery.snippet.min.css",
    ];

    public $js = [
//        "http://www.jtopo.com/demo/js/snippet/jquery.snippet.min.js",
        "http://www.jtopo.com/download/jtopo-0.4.8-min.js",
//        "http://www.jtopo.com/demo/js/toolbar.js",
    ];
}