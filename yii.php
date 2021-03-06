<?php
class Yii extends \yii\BaseYii
{
    /**
     * @var BaseApplication|WebApplication|ConsoleApplication the application instance
     */
    public static $app;

    /**
     * @var \common\components\services\Application the application services
     */
    public static $service;
}

spl_autoload_register(['Yii', 'autoload'], true, true);
Yii::$classMap = include(__DIR__ . '/vendor/yiisoft/yii2/classes.php');
Yii::$container = new yii\di\Container;

/**
 * Class BaseApplication
 * Used for properties that are identical for both WebApplication and ConsoleApplication
 *
 * @property \pheme\settings\components\Settings $settings
 * @property \common\rewrite\web\User $user
 * @property \yii\db\Connection $db_test
 * @property \yii\db\Connection $db_genealogy
 * @property \yii\queue\db\Queue $queue
 * @property \herroffizier\yii2um\UploadManager $uploads
 * @property \creocoder\flysystem\LocalFilesystem $fs_local
 * @property \creocoder\flysystem\SftpFilesystem $sftp_local
 * @property \xplqcloud\cos\Cos $cos
 * @property \takashiki\yii2\flysystem\CosFilesystem $cosFs
 * @property \common\components\wodrow\filesystem\Nos $nos
 */
abstract class BaseApplication extends yii\base\Application
{
}

/**
 * Class WebApplication
 * Include only Web application related components here
 */
class WebApplication extends yii\web\Application
{
}

/**
 * Class ConsoleApplication
 * Include only Console application related components here
 */
class ConsoleApplication extends yii\console\Application
{
}