<?php
$params = [
    'adminEmail' => 'admin@example.com',
];
$params = \yii\helpers\ArrayHelper::merge($params, \common\config\Env::$params);
return $params;