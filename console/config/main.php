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
            'class' => \omnilight\scheduling\ScheduleController::className(),
            'scheduleFile' => '@app/schedule.php'
        ],
        'fixture' => [
            'class' => 'yii\console\controllers\FixtureController',
            'namespace' => 'common\fixtures',
        ],
    ],
    'components' => [
        'user' => [
            'class' => \common\rewrite\web\User::className(),
            'identityClass' => \common\models\User::className(),
            'isInConsole' => true,
            'enableAutoLogin' => true,
            'enableSession' => false,
        ]
    ],
    'modules' => [
        'crawler' => [
            'class' => \console\modules\crawler\CrawlerModule::className(),
        ],
    ],
    'as login' => [
        'class' => \console\behaviors\UserLogin::className(),
    ],
    'params' => $params,
];
