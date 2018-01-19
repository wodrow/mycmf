<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-19
 * Time: 下午12:42
 */

namespace common\components\tools;


class Url extends \yii\helpers\Url {

    public static function toHash($router, $schema = false) {
        $r = $router[0];
        unset($router[0]);
        return \yii\helpers\Url::base($schema) . '/#' . $r . (!empty($router) ? '&'.http_build_query($router) : '');
    }
}