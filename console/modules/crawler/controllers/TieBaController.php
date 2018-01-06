<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-6
 * Time: 下午5:43
 */

namespace console\modules\crawler\controllers;


use yii\console\Controller;

class TieBaController extends Controller
{
    /**
     * php yii crawler/tie-ba/test
     */
    public function actionTest()
    {
        echo 123456;
    }

    /**
     * php yii crawler/tie-ba/test
     * @param $url
     */
    public function actionGetTieBaStory($url)
    {
        echo $url;
    }
}