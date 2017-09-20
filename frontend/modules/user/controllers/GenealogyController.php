<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/14/17
 * Time: 9:57 AM
 */

namespace frontend\modules\user\controllers;


use common\components\tools\ArrayHelper;
use common\components\tools\Tools;
use common\models\Enum;
use common\models\genealogy\UserGroup;
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
        $query = UserGroup::find()->where(['user_id'=>\Yii::$app->user->id]);
        $countQuery = clone $query;
        $pages = new Pagination([
            'totalCount' => $countQuery->count(),
            'pageSize' => 20,
        ]);
        $user_groups = $query
            ->offset($pages->offset)
            ->limit($pages->limit)
            ->all();
        return $this->render('index', [
            'user_groups' => $user_groups,
            'pages' => $pages,
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

    public function actionMapView($id)
    {
        $group = \common\models\genealogy\Group::findOne($id);
        $members = \common\models\genealogy\Member::findAll(['group_id'=>$id]);
        $data = [];
        foreach ($members as $k => $v){
            $x = [];
            $x['key'] = $v->id;
            $x['n'] = $v->name;
            $x['s'] = $v->sex==Enum::SEX_MAN?"M":"F";
            if ($v->father_id)$x['f']=$v->father_id;
            if ($v->mother_id)$x['m']=$v->mother_id;
            if ($v->spouse_id)$x['ux']=$v->spouse_id;
            $y = [];
            foreach ($x as $k1 => $v1){
                if (in_array($k1, ['key', 'f', 'm', 'ux'])){
                    $y[] = $k1.': '.$v1;
                }else{
                    $y[] = $k1.': "'.$v1.'"';
                }
            }
            $data[] = '{'.ArrayHelper::arr2str($y)."}";
        }
        $data = ArrayHelper::arr2str($data);

        $data = <<<js
            [$data];
js;

        return $this->render('map-view', [
            'group' => $group,
            'members' => $members,
            'data' => $data,
        ]);
    }
}