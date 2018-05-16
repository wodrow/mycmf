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
        'fs_local' => [
            'class' => \creocoder\flysystem\LocalFilesystem::className(),
            'path' => '/var/www/test',
        ],
        'sftp_local' => [
            'class' => \creocoder\flysystem\SftpFilesystem::className(),
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
    $config['components']['db']['dsn'] = 'mysql:host=127.0.0.1;dbname=mycmf';
    $config['components']['db']['username'] = 'root';
    $config['components']['db']['password'] = 'root';
}

return $config;
