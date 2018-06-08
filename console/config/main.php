<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-console',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'console\controllers',
    'controllerMap' => [
        'schedule' => [
            'class' => \omnilight\scheduling\ScheduleController::class,
            'scheduleFile' => '@app/schedule.php'
        ],
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
        ],
        'swoole' => [
            'class' => feehi\console\SwooleController::className(),
            'rootDir' => str_replace('console/config', '', __DIR__ ),//yii2项目根路径
            'type' => 'advanced',//yii2项目类型，默认为advanced。此处还可以为basic
            'app' => 'frontend',//app目录地址,如果type为basic，这里一般为空
            'host' => '127.0.0.1',//监听地址
            'port' => 9521,//监听端口
            'web' => 'web',//默认为web。rootDir app web目的是拼接yii2的根目录，如果你的应用为basic，那么app为空即可。
            'debug' => true,//默认开启debug，上线应置为false
            'env' => 'dev',//默认为dev，上线应置为prod
            'swooleConfig' => [//标准的swoole配置项都可以再此加入
                'reactor_num' => 2,
                'worker_num' => 4,
                'daemonize' => false,
                'log_file' => __DIR__ . '/../../console/runtime/logs/swoole.log',
                'log_level' => 0,
                'pid_file' => __DIR__ . '/../../console/runtime/server.pid',
            ],
        ],
    ],
    'components' => [
        'user' => [
            'class' => \common\rewrite\web\User::class,
            'identityClass' => \common\models\User::class,
            'isInConsole' => true,
            'enableAutoLogin' => true,
            'enableSession' => false,
        ]
    ],
    'modules' => [
        'crawler' => [
            'class' => \console\modules\crawler\CrawlerModule::class,
        ],
    ],
    'as login' => [
        'class' => \console\behaviors\UserLogin::class,
    ],
    'params' => $params,
];
