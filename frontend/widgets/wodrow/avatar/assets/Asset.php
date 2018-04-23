<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\widgets\wodrow\avatar\assets;

/**
 * Description of Asset
 *
 * @author wodrow
 */
class Asset extends \kartik\base\AssetBundle
{
    public $css = [
        'https://cdn.bootcss.com/cropper/4.0.0/cropper.min.css',
        'css/crop-avatar-main.css',
    ];
    
    public $js = [
        'https://cdn.bootcss.com/cropper/4.0.0/cropper.min.js',
        'js/crop-avatar-main.js',
    ];

    /**
     * 初始化：sourcePath赋值
     * @see \yii\web\AssetBundle::init()
     */
    public function init()
    {
        $this->sourcePath = dirname(dirname(__FILE__)).DIRECTORY_SEPARATOR . 'statics';
    }
}
