<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-6
 * Time: 下午5:43
 */

namespace frontend\modules\crawler\controllers;


use common\components\tools\ArrayHelper;
use frontend\modules\crawler\models\TieBa;
use frontend\modules\crawler\models\TieBaStoryForm;
use frontend\modules\crawler\models\TieBaStorySaveForm;
use QL\QueryList;
use yii\web\Controller;

class TieBaController extends Controller
{
    /**
     * 采集帖子信息
     * @param string $url
     */
    public function actionGetTieBaStory()
    {
        $model = new TieBaStoryForm();
        $save_form = new TieBaStorySaveForm();
        if ($model->load(\Yii::$app->request->post())&&$model->validate()){
            $ql = QueryList::getInstance()->get($model->url);
            $save_form->title = $ql->find('title')->text();
            $pages = $ql->find('.l_reply_num')->find('.red:eq(1)')->text();
            $contents = [];
            for ($i = 1; $i <= $pages; $i++){
                if ($i == 1){
                    $_ql = $ql;
                }else{
                    $_ql = QueryList::getInstance()->get($model->url."?pn={$i}");
                }
                $_contents = $_ql->find('.j_d_post_content')->texts();
                foreach ($_contents as $k => $v){
                    $x = $v;
                    if (TieBa::checkIsStory($x)){
                        $contents[] = $x;
                    }else{
                        $contents[] = "";
                    }
                }
            }
            $save_form->contents = ArrayHelper::arr2str($contents, '');
        }
        return $this->render('get-tie-ba-story', [
            'model' => $model,
            'save_form' => $save_form,
        ]);
    }
}