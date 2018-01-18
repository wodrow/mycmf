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
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-frontend',
        ],
        'user' => [
            'class' => \common\rewrite\web\User::className(),
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-frontend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the frontend
            'name' => 'advanced-frontend',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'assetManager' => [
            'class' => 'yii\web\AssetManager',
//            'appendTimestamp' => true,
//            'forceCopy' => true,
//            'linkAssets' => true,
        ],
        /*
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
        */
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
            'class' => \frontend\modules\crawler\CrawlerModule::className(),
        ],
    ],
    'as access' => [
        'class' => \frontend\components\behaviors\Check::className(),
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
