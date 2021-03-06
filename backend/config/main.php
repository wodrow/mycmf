<?php
$params = array_merge(
    require(__DIR__ . '/../../common/config/params.php'),
    require(__DIR__ . '/../../common/config/params-local.php'),
    require(__DIR__ . '/params.php'),
    require(__DIR__ . '/params-local.php')
);

return [
    'id' => 'app-backend',
    'basePath' => dirname(__DIR__),
    'controllerNamespace' => 'backend\controllers',
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
            'class' => \common\rewrite\web\User::class,
            'identityClass' => 'common\models\User',
            'enableAutoLogin' => true,
            'identityCookie' => ['name' => '_identity-backend', 'httpOnly' => true],
        ],
        'session' => [
            // this is the name of the session cookie used for login on the backend
            'name' => 'advanced-backend',
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
            ],
        ],
    ],
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => \common\models\User::class,
                    'idField' => 'user_id',
                    'usernameField' => 'username',
                    'extraColumns' => [
                        'email',
                        [
                            'attribute' => 'created_at',
//                            'label' => '创建时间',
                            'format' => ['date', 'php:Y-m-d H:i:s'],
                            'value' => function ($model) {
                                return $model->created_at;
                            }
                        ],
                        [
                            'attribute' => 'updated_at',
//                            'label' => '更新时间',
                            'format' => ['date', 'php:Y-m-d H:i:s'],
                            'value' => function ($model) {
                                return $model->created_at;
                            }
                        ],
                        [
                            'class' => \common\components\grid\EnumColumn::class,
                            'attribute' => 'status',
                            'enum' => \common\models\User::getStatus(),
                        ],
                    ],
                    'searchClass' => 'backend\models\UserSearch',
                ],
            ],
            'layout' => 'left-menu',
            'mainLayout' => '@app/views/layouts/main.php',
            'menus' => [
                'assignment' => [
                    'label' => '用户授权' // change label
                ],
//                'user' => null, // disable menu
            ],
        ],
        'settings' => [
            'class' => 'pheme\settings\Module',
//            'sourceLanguage' => 'en',
        ],
        'gridview' => [
            'class' => \kartik\grid\Module::class,
            // see settings on http://demos.krajee.com/grid#module
        ],
        'datecontrol' => [
            'class' => \kartik\datecontrol\Module::class,
            // see settings on http://demos.krajee.com/datecontrol#module
        ],
        // If you use tree table
        /*'treemanager' =>  [
            'class' => \kartik\tree\Module::class,
            // see settings on http://demos.krajee.com/tree-manager#module
        ],*/
        'dynagrid'=>[
            'class'=>\kartik\dynagrid\Module::class,
            // other settings (refer documentation)
        ],
        'treemanager' =>  [
            'class' => '\kartik\tree\Module',
            // other module settings, refer detailed documentation
        ],
        'webshell' => [
            'class' => 'samdark\webshell\Module',
            'yiiScript' => Yii::getAlias('@wroot'). '/../yii', // adjust path to point to your ./yii script
            /*'allowedIPs' => ['127.0.0.1', '::1', '192.168.0.2'],
            'checkAccessCallback' => function (\yii\base\Action $action) {
                // return true if access is granted or false otherwise
                return true;
            }*/
        ],
        'tag' => [
            'class' => 'backend\modules\tag\TagModule',
        ],
        'log' => [
            'class' => 'backend\modules\log\LogModule',
        ],
        'test' => [
            'class' => 'backend\modules\test\TestModule',
        ],
    ],
    'as access' => [
        'class' => \mdm\admin\components\AccessControl::class,
        'allowActions' => [
            'debug/*',
            'gii/*',
            'site/*',//允许访问的节点，可自行添加
//            'admin/*',//允许所有人访问admin节点及其子节点
//            '*',
        ]
    ],
    'params' => $params,
];
