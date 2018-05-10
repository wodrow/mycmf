<?php
/**
 *
 * User: winds
 * Date: 15-7-27
 * Time: 下午1:50
 */

namespace common\widgets\wdteam\yii2webuploader;

use yii\web\AssetBundle;

class WebuploaderAsset extends AssetBundle
{
    public $css = [
        'https://cdn.bootcss.com/webuploader/0.1.1/webuploader.flashonly.js',
    ];

    public $js = [
      'https://cdn.bootcss.com/webuploader/0.1.1/webuploader.min.js',
    ];
}