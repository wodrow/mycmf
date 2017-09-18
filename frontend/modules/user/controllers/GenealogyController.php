<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/14/17
 * Time: 9:57 AM
 */

namespace frontend\modules\user\controllers;


use common\models\Enum;
use frontend\modules\user\models\genealogy\Group;
use frontend\modules\user\models\genealogy\GroupSearchForm;
use yii\data\Pagination;
use yii\db\Exception;
use yii\web\Controller;

class GenealogyController extends Controller
{
    public function actionIndex()
    {
        $search_form = new GroupSearchForm();
        if ($search_form->load(\Yii::$app->request->post())){
            $query = $search_form->search();
        }else{
            $query = Group::find()->orderBy(['created_at'=>SORT_DESC])->where(['status'=>Enum::STATUS_ACTIVE]);
        }
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
            'search_form' => $search_form,
        ]);
    }

    public function actionGroupSearch()
    {
        $search_form = new GroupSearchForm();
        if ($search_form->load(\Yii::$app->request->post())){
            $query = $search_form->search();
        }else{
            $query = Group::find()->orderBy(['created_at'=>SORT_DESC])->where(['status'=>Enum::STATUS_ACTIVE]);
        }
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 10,
        ]);
        $groups = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('group-search', [
            'groups' => $groups,
            'pages' => $pages,
            'search_form' => $search_form,
        ]);
    }

    public function actionGroupCreate()
    {
        $group = new Group();
        $group->mark = time().\Yii::$app->security->generateRandomString(30);
        if ($group->load(\Yii::$app->request->post())&&$group->validate()){
            $trans = \Yii::$app->db_genealogy->beginTransaction();
            try{
                $group->save();
                $trans->commit();
                $this->redirect(['index']);
            }catch (Exception $e){
                $trans->rollBack();
                throw $e;
            }
        }
        return $this->render('group-create', [
            'group' => $group,
        ]);
    }

    public function actionGroupUpdate($id)
    {
        $group = Group::findOne($id);
        if ($group->load(\Yii::$app->request->post())&&$group->validate()){
            $trans = \Yii::$app->db_genealogy->beginTransaction();
            try{
                $group->save();
                $trans->commit();
                $this->redirect(['index']);
            }catch (Exception $e){
                $trans->rollBack();
                throw $e;
            }
        }
        return $this->render('group-update', [
            'group' => $group,
        ]);
    }
}