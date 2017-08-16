<?php
defined('YII_DEBUG') or define('YII_DEBUG', true);
defined('YII_ENV') or define('YII_ENV', 'dev');

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../yii.php';

// Config
require __DIR__.'/../common/config/bootstrap.php';
require __DIR__.'/../frontend/config/bootstrap.php';

//
//if (!checkInstalled()) {
//    header("Location:install.php");
//    die;
//}

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__.'/../common/config/main.php'),
    require(__DIR__.'/../common/config/main-local.php'),
    require(__DIR__.'/../frontend/config/main.php'),
    require(__DIR__.'/../frontend/config/main-local.php')
);
(new yii\web\Application($config))->run();
