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
    'modules' => [
        'admin' => [
            'class' => 'mdm\admin\Module',
            'controllerMap' => [
                'assignment' => [
                    'class' => 'mdm\admin\controllers\AssignmentController',
                    'userClassName' => \common\models\User::className(),
                    'idField' => 'user_id',
                    'usernameField' => 'username',
                    'extraColumns' => [
                        'email',
                        [
                            'label' => 'created_at',
                            'format' => ['date', 'php:Y-m-d H:i:s'],
                            'value' => function ($model) {
                                return $model->created_at;
                            }
                        ],
                        [
                            'label' => 'updated_at',
                            'format' => ['date', 'php:Y-m-d H:i:s'],
                            'value' => function ($model) {
                                return $model->created_at;
                            }
                        ],
                    ],
//                    'searchClass' => 'backend\models\UserSearch',
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
        ]
    ],
    'components' => [
        'request' => [
            'csrfParam' => '_csrf-backend',
        ],
        'user' => [
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
    ],
    'as access' => [
        'class' => \mdm\admin\components\AccessControl::className(),
        'allowActions' => [
            'site/*',//允许访问的节点，可自行添加
//            'admin/*',//允许所有人访问admin节点及其子节点
//            '*',
        ]
    ],
    'params' => $params,
];
