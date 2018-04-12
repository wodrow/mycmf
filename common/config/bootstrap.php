<?php
define("BOOT_TIME", time());
$_rootPath = dirname(dirname(__DIR__));
Yii::setAlias('@root', $_rootPath); // 根目录
Yii::setAlias('@common', dirname(__DIR__));
Yii::setAlias('@frontend', $_rootPath . '/frontend');
Yii::setAlias('@backend', $_rootPath . '/backend');
Yii::setAlias('@backend_1', $_rootPath . '/backend_1');
Yii::setAlias('@console', $_rootPath . '/console');
Yii::setAlias('@api', $_rootPath . '/api');
Yii::setAlias('@data', $_rootPath . '/data');
//Yii::setAlias('wechat', $_rootPath . '/wechat');
//Yii::setAlias('database', $_rootPath . '/database');
//Yii::setAlias('plugins', $_rootPath . '/plugins');
//Yii::setAlias('@rootPath', $_rootPath); // 根目录
Yii::setAlias('@resource', $_rootPath . '/web/resource'); // 资源目录
//Yii::setAlias('@resourceUrl', '/resource'); // 资源目录
//Yii::setAlias('@addons', $_rootPath . '/web/addons'); // 插件绝对路径目录
//Yii::setAlias('@addonurl', '/addons'); // 插件url
//Yii::setAlias('@attachment', $_rootPath . '/web/attachment'); // 附件路径
//Yii::setAlias('@attachurl', '/attachment'); // 附件二级域名->配置apache
//Yii::setAlias('@basics', $_rootPath . '/backend_1/rewrite/jianyan74/basics');

Yii::setAlias('@wroot', $_rootPath . '/web');
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