<?php

$config = [
    'components' => [
        'request' => [
            // !!! insert a secret key in the following (if it is empty) - this is required by cookie validation
            'cookieValidationKey' => '',
        ],
    ],
];

if (Yii_ENV!='prod') {
    // configuration adjustments for 'dev' environment
    $config['bootstrap'][] = 'debug';
    $config['modules']['debug'] = [
        'class' => 'yii\debug\Module',
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

    $config['bootstrap'][] = 'gii';
    $config['modules']['gii'] = [
        'class' => 'yii\gii\Module',
        'allowedIPs' => ['127.0.0.1', '::1', 'localhost', '192.168.*'],
    ];
}

return $config;
