<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/14/17
 * Time: 9:57 AM
 */

namespace frontend\modules\user\controllers;


use frontend\modules\user\models\genealogy\Group;
use yii\data\Pagination;
use yii\web\Controller;

class GenealogyController extends Controller
{
    public function actionIndex()
    {
        $query = Group::find()->orderBy(['created_at'=>SORT_DESC]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 10,
        ]);
        $groups = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'groups' => $groups,
            'pages' => $pages,
        ]);
    }
}