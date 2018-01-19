<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-19
 * Time: 下午12:40
 */

namespace common\components\tools;


class ModelHelper
{
    public static function normalizeAttribute($model, $attribute) {
        $tt = explode('.', $attribute);
        $result = null;
        $field = "";
        $c = count($tt);
        foreach($tt as $index => $row) {
            $field.= "->$row";
            if (!isset($model->$field)) {
                return null;
            } else if ($index == $c-1) {
                $result = $model->$field;
            }
        }
        return $result;
    }
}