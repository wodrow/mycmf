<?php
$config = [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=mycmf',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix' => 'mycmf_',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file bygit  default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
        'redis' => [
            'class' => 'yii\redis\Connection',
            'hostname' => '127.0.0.1',
            'port' => 6379,
            'database' => 0,
        ],
        'cache' => [
            'class' => \yii\redis\Cache::class,
            'keyPrefix' => '',
        ],
        'session' => [
            'class' => \yii\redis\Session::class,
            'keyPrefix' => '',
        ],
        'fs_local' => [
            'class' => \creocoder\flysystem\LocalFilesystem::class,
            'path' => '/var/www/test',
        ],
        'sftp_local' => [
            'class' => \creocoder\flysystem\SftpFilesystem::class,
            'host' => 'localhost',
            'username' => '',
            'password' => '',
            'port' => 22,
        ],
        'cos'=>[ // yii2上传文件到腾讯云对象存储组件
            'class'=>'xplqcloud\cos\Cos',
            'app_id' => 'app_id',
            'secret_id' => 'secret_id',
            'secret_key' => 'secret_key',
            'region' => 'region',
            'bucket'=>'bucket',
            'insertOnly'=>true,
            'timeout' => 200
        ],
        'cosFs' => [
            'class' => \takashiki\yii2\flysystem\CosFilesystem::class,
            'app_id' => 'xxx',
            'secret_id' => 'xxx',
            'secret_key' => 'xxx',
            'bucket' => 'xxx',
            'domain' => 'xxx.file.myqcloud.com',

            // not necessarily bellow
            'version' => 'v4',
            'protocol' => 'http',
            'region' => 'sh',
            'timeout' => 60,
        ],
        'nos' => [
            'class' => \common\components\wodrow\filesystem\Nos::class,
            'region' => '华东1',
            'bucketName' => '',
            'key' => '',
            'secret' => '',
            'domain' => '',
            'endpoint' => 'http://nos-eastchina1.126.net',
        ],
    ],
];

if (YII_ENV=='dev'){
    $config['components']['db']['dsn'] = 'mysql:host=120.92.150.43;dbname=test_mycmf';
    $config['components']['db']['username'] = 'wodrow';
    $config['components']['db']['password'] = 'Yc51234511';
}

return $config;
