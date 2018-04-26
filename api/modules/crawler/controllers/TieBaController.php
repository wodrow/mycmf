<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-6
 * Time: 下午5:43
 */

namespace api\modules\crawler\controllers;


use api\modules\crawler\models\TieBa;
use deepziyu\yii\rest\Controller;
use QL\QueryList;

class TieBaController extends Controller
{
    /**
     * 采集帖子信息
     * @param string $url
     */
    public function actionGetTieBaStory($url)
    {
        $b = [];
        $ql = QueryList::getInstance()->get($url);
        $b['title'] = $ql->find('title')->text();
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
        $b['content'] = $content;
        return $b;
    }
}