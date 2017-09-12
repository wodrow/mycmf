<?php
Yii::setAlias('@root', dirname(dirname(__DIR__)));
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
//Yii::setAlias('api', dirname(dirname(__DIR__)) . '/api');
//Yii::setAlias('wechat', dirname(dirname(__DIR__)) . '/wechat');
//Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
//Yii::setAlias('database', dirname(dirname(__DIR__)) . '/database');
//Yii::setAlias('plugins', dirname(dirname(__DIR__)) . '/plugins');

Yii::setAlias('@wroot', dirname(dirname(__DIR__)) . '/web');
Yii::setAlias('@wurl', \common\config\Env::HOME_URL);

//Yii::$classMap['yii\helpers\Markdown'] = '@common/helpers/Markdown.php';

Yii::$container->set('yii\widgets\LinkPager', ['maxButtonCount' => 9, 'firstPageLabel' => '首页', 'prevPageLabel'=>'上一页', 'nextPageLabel'=>'下一页', 'lastPageLabel' => '末页']);
Yii::$container->set('yii\widgets\Pjax', ['timeout' => false]);