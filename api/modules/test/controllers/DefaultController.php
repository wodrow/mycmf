<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-11
 * Time: 上午8:53
 */

namespace api\modules\test\controllers;


use deepziyu\yii\rest\Controller;

class DefaultController extends Controller
{
    /**
     * 说明
     * @desc get/post
     * @param mixed $x
     * @return mixed x
     */
    public function actionIndex($x)
    {
        return [
            'x' => $x,
        ];
    }
}