<?php
define('DOMAIN', $_SERVER['HTTP_HOST']);
if (substr(DOMAIN, 0, 5) == 'test.'){
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
}else{
    defined('YII_DEBUG') or define('YII_DEBUG', false);
    defined('YII_ENV') or define('YII_ENV', 'prod');
}

require __DIR__.'/../vendor/autoload.php';
require __DIR__.'/../yii.php';

// Config
require __DIR__.'/../common/config/bootstrap.php';
require __DIR__.'/../frontend/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__.'/../common/config/main.php'),
    require(__DIR__.'/../common/config/main-local.php'),
    require(__DIR__.'/../frontend/config/main.php'),
    require(__DIR__.'/../frontend/config/main-local.php')
);

/**
 * 添加服务 ，Yii::$services  ,  将services的配置添加到这个对象。
 * 使用方法：Yii::$services->cms->article;
 * 上面的例子就是获取cms服务的子服务article。
 */
new \common\components\services\Application($config['services']);
unset($config['services']);

(new yii\web\Application($config))->run();
