<?php
/**
 * Created by PhpStorm.
 * User: singletonn
 * Date: 2/16/18
 * Time: 3:26 PM
 */

namespace common\widgets\wodrow\textavatar;


use yii\web\AssetBundle;

class TextAvatarAssets extends AssetBundle
{
    public $css = [
        'css/style.css',
    ];

    public function init()
    {
        $this->sourcePath = dirname(__FILE__).DIRECTORY_SEPARATOR . 'assets';
    }
}