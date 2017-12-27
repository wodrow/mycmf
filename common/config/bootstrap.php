<?php
Yii::setAlias('@root', dirname(dirname(__DIR__)));
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', dirname(dirname(__DIR__)) . '/frontend');
Yii::setAlias('@backend', dirname(dirname(__DIR__)) . '/backend');
Yii::setAlias('@console', dirname(dirname(__DIR__)) . '/console');
Yii::setAlias('@api', dirname(dirname(__DIR__)) . '/api');
Yii::setAlias('@data', dirname(dirname(__DIR__)) . '/data');
//Yii::setAlias('api', dirname(dirname(__DIR__)) . '/api');
//Yii::setAlias('wechat', dirname(dirname(__DIR__)) . '/wechat');
//Yii::setAlias('console', dirname(dirname(__DIR__)) . '/console');
//Yii::setAlias('database', dirname(dirname(__DIR__)) . '/database');
//Yii::setAlias('plugins', dirname(dirname(__DIR__)) . '/plugins');

Yii::setAlias('@wroot', dirname(dirname(__DIR__)) . '/web');
Yii::setAlias('@wurl', \common\config\Env::HOME_URL);

//Yii::$classMap['yii\helpers\Markdown'] = '@common/helpers/Markdown.php';

Yii::$container->set('yii\data\Pagination', [
//    'totalCount', //为数据总数,
    'pageSize' => 10, //为每页显示数,
    'pageSizeParam'=>false, //可将分页路径中per-page参数隐藏去掉,
    'pageParam' => 'p', //可更改分页url中分页参数name名称,
//    'route' => false, //分页在于首页时隐藏掉路由，将/site/index?p=1变为/?p=1,
    'validatePage' => false, //取消分页验证,当手动输入page=20时不再跳到page=1,
]);
Yii::$container->set('yii\widgets\LinkPager', [
    'maxButtonCount' => 9, 
    'firstPageLabel' => '首页', 
    'lastPageLabel' => '末页',
    'prevPageLabel'=>'上一页', 
    'nextPageLabel'=>'下一页',
]);
Yii::$container->set('yii\widgets\Pjax', [
    'timeout' => false,
]);
Yii::$container->set('yii\captcha\CaptchaAction', [
    'minLength' => 4, 
    'maxLength' => 4, 
    'fontFile' => '@data/fonts/ztgjkt.ttf',
]);