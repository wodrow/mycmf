<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-6
 * Time: 下午5:43
 */

namespace console\modules\crawler\controllers;


use common\components\tools\ArrayHelper;
use common\components\tools\Tools;
use console\modules\crawler\models\TieBa;
use QL\QueryList;
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
     * php yii crawler/tie-ba/get-tie-ba-story
     * @param $url
     */
    public function actionGetTieBaStory($url)
    {
        $ql = QueryList::getInstance()->get($url);
        $title = $ql->find('title')->text();
        $pages = $ql->find('.l_reply_num')->find('.red:eq(1)')->text();
        $content = "";
        for ($i = 1; $i <= $pages; $i++){
            if ($i == 1){
                $_ql = $ql;
            }else{
                $_ql = QueryList::getInstance()->get($url."?pn={$i}");
            }
            $contents = $_ql->find('.j_d_post_content')->texts();
            foreach ($contents as $k => $v){
                $x = $v;
                if (TieBa::checkIsStory($x)){
                    $content .= $x;
                }else{
                    $content .= "";
                }
            }
        }
        echo $content;
    }
}