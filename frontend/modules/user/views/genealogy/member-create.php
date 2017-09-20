<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\user\models\genealogy\Member $member
 */
$this->title = "添加成员";
$this->params['breadcrumbs'][] = \yii\helpers\Html::a('用户中心', ['/user']);
$this->params['breadcrumbs'][] = \yii\helpers\Html::a('我的族谱', ['/user/genealogy']);
$this->params['breadcrumbs'][] = \yii\helpers\Html::a($member->group->title, ['/user/genealogy/group-view', 'id'=>$member->group_id]);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-genealogy-member-create">
    <div class="row">
        <div class="col-lg-12">
            <?=$this->render('_member_form', ['member'=>$member]) ?>
        </div>
    </div>
</div>
