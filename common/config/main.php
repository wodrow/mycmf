<?php
$config = [
    'version' => \common\config\Env::VERSION,
    'vendorPath' => dirname(dirname(__DIR__)) . '/vendor',
    'language' => 'zh-CN',
    'bootstrap' => ['log', 'cache', 'assetMinifier'],
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
        'assetMinifier' => [
            'class' => \lajax\assetminifier\Component::className(),
//            'minifyJs' => true,                     // minify js files. [default]
//            'minifyCss' => true,                    // minify css files [default]
//            'combine' => true,                      // combine asset files. [default]
//            'createGz' => false,                    // create compressed .gz file, (so the web server doesn’t need to
//            // compress asset files on each page view). Requires
//            // special web server configuration. [default]
//            'minifier' => [                         // Settings of the components performing the minification of asset files
//                'workPath' => lajax\assetminifier\Minifier::WORKPATH_SOURCE, // default setting
//                'js' => 'site_js', // override default minifier, see available minifiers below
//                'css' => 'site_css', // override default minifier, see available minifiers below
//            ],
//            'combiner' => [
//                'class' => 'lajax\assetminifier\Combiner',
//                'combinedFilesPath' => '/lajax-asset-minifier'      // default setting
//            ],
        ],
        'storge' => [
            'class' => 'weyii\filesystem\Manager',
            'default' => 'local',
            'disks' => [
                'local' => [
                    'class' => 'weyii\filesystem\adapters\Local',
                    'root' => '@webroot/storage' // 本地存储路径
                ],
                'qiniu' => [
                    'class' => 'weyii\filesystem\adapters\QiNiu',
                    'accessKey' => '七牛AccessKey',
                    'accessSecret' => '七牛accessSecret',
                    'bucket' => '七牛bucket空间',
                    'baseUrl' => '七牛基本访问地址, 如:http://72g7lu.com1.z0.glb.clouddn.com'
                ],
                'upyun' => [
                    'class' => 'weyii\filesystem\adapters\UpYun',
                    'operatorName' => '又拍云授权操作员账号',
                    'operatorPassword' => '又拍云授权操作员密码',
                    'bucket' => '又拍云的bucket空间',
                ],
                'aliyun' => [
                    'class' => 'weyii\filesystem\adapters\AliYun',
                    'accessKeyId' => '阿里云OSS AccessKeyID',
                    'accessKeySecret' => '阿里云OSS AccessKeySecret',
                    'bucket' => '阿里云的bucket空间',
                    // lanUrl和wanUrl样只需填写一个. 如果填写lanUrl 将优先使用lanUrl作为传输地址
                    // 外网和内网的使用参考: https://help.aliyun.com/document_detail/oss/user_guide/oss_concept/endpoint.html?spm=5176.2020520105.0.0.tpQOiL
                    'lanDomain' => 'OSS内网地址, 如:oss-cn-hangzhou-internal.aliyuncs.com', // 默认不填. 在生产环境下保证OSS和服务器同属一个区域机房部署即可, 切记不能带上bucket前缀
                    'wanDomain' => 'OSS外网地址, 如:oss-cn-hangzhou.aliyuncs.com' // 默认为杭州机房domain, 其他机房请自行替换, 切记不能带上bucket前缀
                ],
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