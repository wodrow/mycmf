<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/4/17
 * Time: 1:39 PM
 */

namespace common\models;


class Enum
{
    const STATUS_DELETE = 0;
    const STATUS_ACTIVE = 10;

    public static function getStatus()
    {
        return [
            self::STATUS_ACTIVE => "正常",
            self::STATUS_DELETE => "已删除",
        ];
    }
}