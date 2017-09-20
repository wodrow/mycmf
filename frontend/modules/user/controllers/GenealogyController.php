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
use frontend\modules\user\models\genealogy\Member;
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

    public function actionGroupAdd($id)
    {
        #
    }

    public function actionGroupView($id)
    {
        $group = Group::findOne($id);
        $query = Member::find()->orderBy(['borthday'=>SORT_ASC]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 50,
        ]);
        $members = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('group-view', [
            'group' => $group,
            'members' => $members,
            'pages' => $pages,
        ]);
    }

    public function actionMemberCreate($group_id)
    {
        $member = new Member();
        $member->group_id = $group_id;
        if ($member->load(\Yii::$app->request->post())&&$member->validate()){
            $trans = \Yii::$app->db_genealogy->beginTransaction();
            try{
                $member->save();
                $member->spouseEdit();
                $trans->commit();
                $this->redirect(['group-view', 'id'=>$group_id]);
            }catch (Exception $e){
                $trans->rollBack();
                throw $e;
            }
        }
        return $this->render('member-create', [
            'member' => $member,
        ]);
    }

    public function actionMemberUpdate($id)
    {
        $member = Member::findOne(['id'=>$id]);
        $group = $member->group;
        if ($member->load(\Yii::$app->request->post())&&$member->validate()){
            $trans = \Yii::$app->db_genealogy->beginTransaction();
            try{
                $member->save();
                $member->spouseEdit();
                $trans->commit();
                $this->redirect(['group-view', 'id'=>$group->id]);
            }catch (Exception $e){
                $trans->rollBack();
                throw $e;
            }
        }
        return $this->render('member-update', [
            'member' => $member,
        ]);
    }
}