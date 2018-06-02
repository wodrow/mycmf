<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-frontend',
    'name' => 'MyCMF',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'frontend\controllers',
    'bootstrap' => ['log', 'rollbar'],
    'components' => [
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => \yii\log\DbTarget::class,
//                    'class' => 'baibaratsky\yii\rollbar\log\Target',
                    'levels' => ['error'],
                ],
            ],
        ],
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'class' => \common\rewrite\web\User::class,
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'errorHandler' => [
            'class' => 'baibaratsky\yii\rollbar\web\ErrorHandler',
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
//            'appendTimestamp' => true,
//            'forceCopy' => true,
//            'linkAssets' => true,
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        'rollbar' => [
            'class' => 'baibaratsky\yii\rollbar\Rollbar',
//            'accessToken' => 'POST_SERVER_ITEM_ACCESS_TOKEN',
            // You can specify exceptions to be ignored by yii2-rollbar:
            // 'ignoreExceptions' => [
            //         ['yii\web\HttpException', 'statusCode' => [400, 404]],
            //         ['yii\web\HttpException', 'statusCode' => [403], 'message' => ['This action is forbidden']],
            // ],
        ],
    ],
    'modules' => [
        'redactor' => [
            'class' => 'yii\redactor\RedactorModule',
            'uploadDir' => '@wroot/uploads',
            'uploadUrl' => '@wurl/uploads',
            'imageAllowExtensions'=>['jpg','png','gif']
        ],
        'pub' => [
            'class' => 'frontend\modules\pub\PubModule',
        ],
        'user' => [
            'class' => 'frontend\modules\user\UserModule',
        ],
        'td' => [ // 3d
            'class' => 'frontend\modules\td\TdModule',
        ],
        'test' => [ // test
            'class' => 'frontend\modules\test\TestModule',
        ],
        'crawler' => [
            'class' => \frontend\modules\crawler\CrawlerModule::class,
        ],
        'utils' => [
            'class' => \frontend\modules\utils\UtilsModule::class,
        ],
        'videos' => [
            'class' => \frontend\modules\videos\VideosModule::class,
        ],
    ],
    'as access' => [
        'class' => \frontend\components\behaviors\Check::class,
        'except' => [
            'site/*',
            'pub/*',
            'gii/*',
            'debug/*',
            'test/test/*',
        ],
        'rules' => [
            [
                'allow' => true,
                'roles' => ['@'],
            ],
        ],
    ],
    'params' => $params,
];
