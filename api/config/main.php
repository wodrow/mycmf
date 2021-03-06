<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

$config = [
    'id' => 'app-api',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'api\controllers',
    'modules' => [
        'other' => [ // 其他对接
            'class' => 'api\modules\other\OtherModule',
        ],
        'crawler' => [
            'class' => \api\modules\crawler\CrawlerModule::class,
        ],
    ],
    'components' => [
        'request' => [
            'enableCsrfValidation' => false,
            'csrfParam' => '_csrf-api',
//            'parsers' => [
//                'application/json' => 'yii\web\JsonParser',
//                'text/json' => 'yii\web\JsonParser',
//            ],
        ],
        'user' => [
            'class' => \common\rewrite\web\User::class,
            'identityClass' => \api\models\User::class,
            'enableAutoLogin' => true,
            'enableSession' => false,
        ],
        'session' => [
            'name' => 'advanced-api',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [],
        ],
    ],
    'params' => $params,
    'as token-must-be-check' => [
        'class' => \api\behaviors\TokenCheck::class,
        'except' => [
            'gii/*',
            'site/signup',
            'site/get-token-and-key',
            'route/api/index',
            'other/*',
            'crawler/*',
            'test/*',
        ],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
];

if (YII_ENV_DEV) {
    $config['modules']['test'] = [
        'class' => 'api\modules\test\TestModule',
    ];
}

$config = yii\helpers\ArrayHelper::merge(
    $config,
    \deepziyu\yii\rest\Controller::getConfig()
);

return $config;


