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
        'migrate' => [
            'class' => \yii\console\controllers\MigrateController::class,
            'migrationPath' => [
                '@vendor/razonyang/yii2-log/src/migrations',
            ],
        ],
        'log' => [
            'class' => \razonyang\yii\log\LogController::class,
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
