<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-8
 * Time: 下午3:19
 */

namespace common\widgets\wodrow\avatar\assets;


use kartik\widgets\AssetBundle;

class Jcrop extends AssetBundle
{
    public $css = [
        'https://cdn.bootcss.com/jquery-jcrop/2.0.4/css/Jcrop.min.css',
    ];

    public $js = [
        'https://cdn.bootcss.com/jquery-jcrop/2.0.4/js/Jcrop.min.js',
    ];
}