<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
        'authClientCollection' => [
            'class' => \yii\authclient\Collection::class,
            'clients' => [
                'qq' => [
                    'class' => \common\widgets\auth2clients\QQClient::class,
                    'clientId' => '',
                    'clientSecret' => '',
                ],
                'weibo' => [
                    'class' => \common\widgets\auth2clients\WeiboClient::class,
                    'clientId' => '',
                    'clientSecret' => '',
                ],
                'weixin' => [
                    'class' => \common\widgets\auth2clients\WeiXinClient::class,
                    'clientId' => '',
                    'clientSecret' => '',
                ],
                'github' => [
                    'class' => \yii\authclient\clients\GitHub::class,
                    'clientId' => '',
                    'clientSecret' => '',
                ],
            ],
        ],
    ],
];

if (Yii_ENV!='prod') {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
//        'class' => 'yii\debug\Module',
        'class' => 'amnah\yii2\debug\Module',
        'allowedIPs' => ['127.0.0.1', '::1', 'localhost', '192.168.*'],
    ];
    $config['modules']['debug']['panels']['switchUser'] = [
        'class' => 'microinginer\switchUser\SwitchPanel',
        'modelClass' => '\common\models\User',
        /*'queryCondition' => function (\yii\db\ActiveQuery &$query, \yii\db\ActiveRecord $model) {
            $query->andWhere('id IS NOT NULL');
        },
        'gridViewColumns' => [
            'username',
            [
                'attribute' => 'org.name',
                'label' => 'Organization',
            ],
            [
                'label' => Yii::t('app', 'Roles'),
                'value' => function ($model) {
                    $roles = '';
                    foreach (Yii::$app->authManager->getRolesByUser($model->id) as $role) {
                        $roles .= ', ' . $role->name;
                    }
                    $roles = substr($roles, 1);
                    return $roles;
                }
            ],
        ],*/
    ];
    $config['modules']['debug']['panels']['xhprof'] = [
        'class'=>'\trntv\debug\xhprof\panels\XhprofPanel',
    ];
    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', 'localhost', '192.168.*'],
        'generators' => [
            //...
            'fixtureClass'=>[
                'class'=>\insolita\fixturegii\generators\ClassGenerator::class,
                'templates'=>[
                    //add your custom
                ]
            ],
            'fixtureData'=>[
                'class'=>\insolita\fixturegii\generators\DataGenerator::class,
                'tableResolverClass'=>'You can set own implementation',
                'templates'=>[
                    //add your custom
                ]
            ],
            'fixtureTemplate'=>[
                'class'=>\insolita\fixturegii\generators\TemplateGenerator::class,
                'tableResolverClass'=>'You can set own implementation',
                'columnResolverClass'=>'You can set own implementation',
                'templates'=>[
                    //add your custom
                ]
            ],
        ],
    ];
}

return $config;

