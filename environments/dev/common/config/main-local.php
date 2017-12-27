<?php
$config = [
    'components' => [
        'db' => [
            'class' => 'yii\db\Connection',
            'dsn' => 'mysql:host=127.0.0.1;dbname=mycmf',
            'username' => 'root',
            'password' => 'root',
            'charset' => 'utf8',
            'tablePrefix' => '',
        ],
        'mailer' => [
            'class' => 'yii\swiftmailer\Mailer',
            'viewPath' => '@common/mail',
            // send all mails to a file bygit  default. You have to set
            // 'useFileTransport' to false and configure a transport
            // for the mailer to send real emails.
            'useFileTransport' => true,
        ],
    ],
];

if (YII_ENV=='dev'){
    $config['components']['db']['dsn'] = 'mysql:host=127.0.0.1;dbname=mycmf';
    $config['components']['db']['username'] = 'root';
    $config['components']['db']['password'] = 'root';
}

return $config;
