<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 8/16/17
 * Time: 7:16 PM
 */

namespace console\controllers;


use yii\console\Controller;

class TestController extends Controller
{
    /**
     * test swoole
     */
    public function actionTest()
    {
        echo 123465;
    }
}