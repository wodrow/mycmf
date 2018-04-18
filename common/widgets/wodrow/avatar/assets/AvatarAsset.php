<?php
namespace common\widgets\wodrow\avatar\assets;

use Yii;
use yii\web\AssetBundle;

/**
 * @link http://www.yii-china.com/
 * @copyright Copyright (c) 2015 Yii中文网
 * @author Xianan Huang <xianan_huang@163.com>
 */
class AvatarAsset extends AssetBundle
{
    public $css = [
        'css/bootstrap.min.css',
        'css/cropper.min.css',
        'css/main.css',
        //'css/site.css'
    ];
    
    public $js = [
        //'js/respond.min.js',
        'js/jquery-1.12.4.min.js',
        'js/bootstrap.min.js',
        'js/cropper.min.js',
        'js/main.js',
        //'js/site.js',
    ];
    
    public $depends = [
        'yii\web\YiiAsset',
    ];
    public $jsOptions = [  
        'position' => \yii\web\View::POS_HEAD,   // 这是设置所有js放置的位置  
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