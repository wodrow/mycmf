<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\user\models\genealogy\Group $group
 */
$this->title = "创建族谱";
$this->params['breadcrumbs'][] = \yii\helpers\Html::a('用户中心', ['/user']);
$this->params['breadcrumbs'][] = \yii\helpers\Html::a('我的族谱', ['/user/genealogy']);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-genealogy-group-create">
    <div class="row">
        <div class="col-lg-12">
            <?=$this->render('_group_form', ['group'=>$group]) ?>
        </div>
    </div>
</div>
