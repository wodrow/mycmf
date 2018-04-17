<?php

namespace backend\widgets\rageframe\webuploader\assets;

use yii\web\AssetBundle;

class WebuploaderAsset extends AssetBundle {

    public $sourcePath = '@backend/widgets/rageframe/webuploader/statics/webuploader/';

    public $css = [
        'webuploader.css',
    ];

    public $js = [
        'webuploader.min.js',
    ];

    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}