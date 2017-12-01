<?php
$config = [
    'version' => \common\config\Env::VERSION,
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',
    'bootstrap' => ['log'],
    'components' => [
        'cache' => [
            'class' => 'yii\caching\FileCache',
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\DbTarget::className(),
                    'levels' => ['error'],
                ],
            ],
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // 使用数据库管理配置文件
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'settings' => [
            'class' => 'pheme\settings\components\Settings',
        ],
        'uploads' => [
            'class' => 'herroffizier\yii2um\UploadManager',
            // path to upload folder
            'uploadDir' => '@wroot/uploads',
            // url to upload filder
            'uploadUrl' => '@wurl/uploads',
        ],
        'assetManager' => [
            'assetMap' => [
                'AdminLTE.css' => '@wurl/css/AdminLTE.css',
            ],
        ],
    ],
    'modules' => [
        'filemanager' => [
            'class' => 'pendalf89\filemanager\Module',
            // Upload routes
            'routes' => [
                // Base absolute path to web directory
                'baseUrl' => '',
                // Base web directory url
                'basePath' => '@wroot',
                // Path for uploaded files in web directory
                'uploadPath' => 'uploads',
            ],
            // Thumbnails info
            'thumbs' => [
                'small' => [
                    'name' => 's11',
                    'size' => [100, 100],
                ],
                'medium' => [
                    'name' => 's32',
                    'size' => [300, 200],
                ],
                'large' => [
                    'name' => 's54',
                    'size' => [500, 400],
                ],
            ],
        ],
    ],
];

Yii::$container->set('leandrogehlen\treegrid\TreeGridAsset',[
    'js' => [
        'js/jquery.cookie.js',
        'js/jquery.treegrid.min.js',
    ]
]);

return $config;