<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-8
 * Time: 下午8:23
 */

namespace common\models\db;


class Document extends \common\models\db\base\Document
{
    const TYPE_ARTICLE = 1;

    public static function getTypes()
    {
        return [
            self::TYPE_ARTICLE => '文章',
        ];
    }
}