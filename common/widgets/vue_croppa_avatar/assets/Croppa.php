<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-8
 * Time: 上午9:40
 */

namespace common\widgets\vue_croppa_avatar\assets;


use kartik\widgets\AssetBundle;

class Croppa extends AssetBundle
{
    /**
     * 初始化：sourcePath赋值
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        $this->sourcePath = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR . 'statics';
    }

    public $js = [
        'https://cdn.bootcss.com/vue/2.5.15/vue.min.js',
        'https://unpkg.com/vue-croppa/dist/vue-croppa.min.js',
    ];

    public $css = [
        'https://unpkg.com/vue-croppa/dist/vue-croppa.min.css',
    ];
}