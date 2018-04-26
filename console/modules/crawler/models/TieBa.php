<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-7
 * Time: 上午12:20
 */

namespace console\modules\crawler\models;


use yii\base\Model;

class TieBa extends Model
{
    public static function checkWater($content)
    {}

    public static function checkComment($content)
    {
        if (mb_strlen($content, 'utf8') > 50){
            return false;
        }else{
            return true;
        }
    }

    public static function checkIsStory($content)
    {
        if (!self::checkWater($content)&&!self::checkComment($content)){
            return true;
        }else{
            return false;
        }
    }
}