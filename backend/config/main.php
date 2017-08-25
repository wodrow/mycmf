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
        ],
        'settings' => [
            'class' => 'pheme\settings\Module',
//            'sourceLanguage' => 'en',
        ],
        'gridview' => [
            'class' => \kartik\grid\Module::className(),
            // see settings on http://demos.krajee.com/grid#module
        ],
        'datecontrol' => [
            'class' => \kartik\datecontrol\Module::className(),
            // see settings on http://demos.krajee.com/datecontrol#module
        ],
        // If you use tree table
        /*'treemanager' =>  [
            'class' => \kartik\tree\Module::className(),
            // see settings on http://demos.krajee.com/tree-manager#module
        ],*/
        'dynagrid'=>[
            'class'=>\kartik\dynagrid\Module::className(),
            // other settings (refer documentation)
        ],
        'tag' => [
            'class' => 'backend\modules\tag\TagModule',
        ],
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
