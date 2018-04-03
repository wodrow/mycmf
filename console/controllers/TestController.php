<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 8/16/17
 * Time: 7:16 PM
 */

namespace console\controllers;


use common\config\Env;
use yii\console\Controller;

class TestController extends Controller
{
    /**
     * this is a test
     */
    public function actionTest()
    {
        var_dump(Env::DOMAIN);
//        var_dump(\Yii::$app->user);
    }
}