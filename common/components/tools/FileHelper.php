<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-19
 * Time: 上午11:11
 */

namespace common\components\tools;



class FileHelper extends \yii\helpers\FileHelper
{
    public static function getExtensionName1($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION);
    }
}