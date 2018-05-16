<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-16
 * Time: 上午10:50
 */

namespace common\components\budget;


use common\components\tools\FileHelper;

class Nos extends Bed
{
    const NAME = 'nos';
    const TITLE = '网易云对象存储';

    public function uploadLocalFile($file)
    {
        $r = \Yii::$app->nos->putObjectByFilePath('xx.webm', $file);
        return $r;
    }

    public function deleteByUrl($delete_url)
    {

    }

    public function uploadFormUrl($url)
    {

    }
}