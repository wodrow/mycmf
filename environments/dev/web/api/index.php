<?php
define('DOMAIN', $_SERVER['HTTP_HOST']);
if (substr(DOMAIN, 0, 5) == 'test.'){
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'dev');
}else{
    defined('YII_DEBUG') or define('YII_DEBUG', true);
    defined('YII_ENV') or define('YII_ENV', 'prod');
}

require __DIR__.'/../../vendor/autoload.php';
require __DIR__.'/../../yii.php';

// Config
require __DIR__.'/../../common/config/bootstrap.php';
require __DIR__.'/../../api/config/bootstrap.php';

$config = yii\helpers\ArrayHelper::merge(
    require(__DIR__.'/../../common/config/main.php'),
    require(__DIR__.'/../../common/config/main-local.php'),
    require(__DIR__.'/../../api/config/main.php'),
    require(__DIR__.'/../../api/config/main-local.php')
);
(new yii\web\Application($config))->run();
