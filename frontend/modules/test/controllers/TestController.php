<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 2017/9/25
 * Time: 下午 2:06
 */

namespace frontend\modules\test\controllers;


use Phpml\Association\Apriori;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionTest()
    {
        $samples = [['1', '2', '5'], ['1', '2', '8'], ['1', '2', '5'], ['1', '2', '8']];
        $labels  = [];
        $associator = new Apriori($support = 0.5, $confidence = 0.5);
        $associator->train($samples, $labels);
        $x = $associator->predict(['1','5']);
        var_dump($x);
    }

    public function actionTest1()
    {
        echo (new \TesseractOCR("/var/www/mycmf/web/uploads/DeepinScreenshot_select-area_20170927143745.png"))
            ->lang('eng', 'jpn', 'por')
            ->run();
    }
}