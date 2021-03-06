<?php
$config = [
    'version' => \common\config\Env::VERSION,
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',
    'bootstrap' => [
        'log',
        'queue',
//        'assetsAutoCompress',
    ],
    'components' => [
        'log' => [
//            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
//                    'class' => \yii\log\DbTarget::class,
                    'class' => \razonyang\yii\log\DbTarget::class,
                    'levels' => ['error'],
                    'logTable' => 'log',
                    // rotate settings
                    'rotateInterval' => 100000,
                    // rotate mutex settings
                    'rotateMutex' => 'mutex',
                    'rotateMutexKey' => 'log_rotate',
                    'rotateMutexAcquireTimeout' => 0,
                ],
            ],
        ],
        'mutex' => [
            'class' => \yii\mutex\FileMutex::class,
        ],
        'queue' => [
            'class' => \yii\queue\db\Queue::class,
            'db' => 'db', // DB connection component or its config
            'tableName' => '{{%queue}}', // Table name
            'channel' => 'default', // Queue channel key
            'mutex' => \yii\mutex\MysqlMutex::class, // Mutex used to sync queries
        ],
        'authManager' => [
            'class' => 'yii\rbac\DbManager', // 使用数据库管理配置文件
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
            // 线上建议将forceCopy设置成false，如果访问量不大无所谓
            'forceCopy' => true,
            'assetMap' => [
                'AdminLTE.css' => '@wurl/css/AdminLTE.css',
            ],
        ],
        /*'assetsAutoCompress' => [
            'class' => '\skeeks\yii2\assetsAuto\AssetsAutoCompressComponent',
            'webroot' => '@wroot',
            'enabled' => false,
            'readFileTimeout' => 3,           //Time in seconds for reading each asset file
            'jsCompress' => true,        //Enable minification js in html code
            'jsCompressFlaggedComments' => true,        //Cut comments during processing js
            'cssCompress' => true,        //Enable minification css in html code
            'cssFileCompile' => true,        //Turning association css files
            'cssFileRemouteCompile' => false,       //Trying to get css files to which the specified path as the remote file, skchat him to her.
            'cssFileCompress' => true,        //Enable compression and processing before being stored in the css file
            'cssFileBottom' => false,       //Moving down the page css files
            'cssFileBottomLoadOnJs' => false,       //Transfer css file down the page and uploading them using js

            'jsFileCompile' => true,        //Turning association js files
            'jsFileRemouteCompile' => false,       //Trying to get a js files to which the specified path as the remote file, skchat him to her.
            'jsFileCompress' => true,        //Enable compression and processing js before saving a file
            'jsFileCompressFlaggedComments' => true,        //Cut comments during processing js

            'htmlCompress' => true,        //Enable compression html
            'noIncludeJsFilesOnPjax' => true,        //Do not connect the js files when all pjax requests
            'htmlCompressOptions' => [             //options for compressing output result
                'extra' => false,        //use more compact algorithm
                'no-comments' => true   //cut all the html comments
            ],
        ],*/
    ],
    /** ------ 服务层 ------ **/
    /*'services' => [
        'test' => [
            'class' => 'common\servers\Test',
            // 子服务
            'childService' => [
                'test' => [
                    'class' => 'common\servers\test\Test',
                ],
            ],
        ],
    ],*/
];

Yii::$container->set('leandrogehlen\treegrid\TreeGridAsset', [
    'js' => [
        'js/jquery.cookie.js',
        'js/jquery.treegrid.min.js',
    ]
]);

return $config;