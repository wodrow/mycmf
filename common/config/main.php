<?php
return [
    'version' => \common\config\Env::VERSION,
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'config' => \common\components\config\Config::className(),
    ],
];
