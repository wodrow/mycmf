<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\user\models\genealogy\Group[] $groups
 * @var \yii\data\Pagination $pages
 * @var \frontend\modules\user\models\genealogy\GroupSearchForm $search_form
 */
?>

<div class="user-genealogy-group-search">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="search" style="margin-bottom: 10px;">
                    <?php $form = \kartik\form\ActiveForm::begin([
                        'type' => \kartik\form\ActiveForm::TYPE_INLINE,
                        'options' => []
                    ]); ?>
                    <?=$form->field($search_form, 'mark')->textInput() ?>
                    <?=$form->field($search_form, 'title')->textInput() ?>
                    <?=$form->field($search_form, 'info')->textInput() ?>
                    <?=\yii\helpers\Html::submitButton('搜索', ['class'=>"btn btn-primary"]) ?>
                    <?=\yii\helpers\Html::a('没有找到？去创建', ['/user/genealogy/group-create'], ['class'=>"pull-right btn btn-warning"]) ?>
                    <?php \kartik\form\ActiveForm::end(); ?>
                </div>
                <div class="items">
                    <table class="table table-border">
                        <thead>
                        <tr>
                            <th>名称</th>
                            <th>标示</th>
                            <th></th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($groups as $k => $v): ?>
                            <tr>
                                <td><?=\yii\helpers\Html::a($v->title, ['group-view', 'id' => $v->id], ['title' => $v->info]) ?></td>
                                <td><?=$v->mark ?></td>
                                <td>
                                    <?=$v->owner_id==Yii::$app->user->id?"所有者":(\common\models\genealogy\UserGroup::findOne(['user_id'=>Yii::$app->user->id, 'group_id'=>$v->id])?"已加入":\yii\helpers\Html::a("加入", [''], ['class'=>"btn btn-primary btn-sm"])) ?>
                                </td>
                                <td>
                                    <?php // echo \yii\helpers\Html::a('修改', ['/user/genealogy/group-update', 'id'=>$v->id]) ?>
                                    <?=\yii\helpers\Html::a('浏览谱图', ['', 'id'=>$v->id], ['class'=>"btn btn-info btn-xs"]) ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
                <div class="pages">
                    <?=\yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                        /*'firstPageLabel' => '首页',
                        'lastPageLabel' => '尾页',
                        'prevPageLabel' => '上一页',
                        'nextPageLabel' => '下一页',
                        'maxButtonCount' => 10, //控制每页显示的页数*/
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
