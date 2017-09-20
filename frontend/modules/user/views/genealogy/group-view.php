<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\user\models\genealogy\Group $group
 * @var \common\models\genealogy\Member[] $members
 * @var \yii\data\Pagination $pages
 */
?>

<div class="user-genealogy-group-view">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="search" style="margin-bottom: 10px;">
                    <?=\yii\helpers\Html::a("添加成员", ['member-create', 'group_id'=>$group->id], ['class'=>"btn btn-primary"]) ?>
                </div>
                <div class="items">
                    <table class="table table-border">
                        <thead>
                        <tr>
                            <th>姓名</th>
                            <th>性别</th>
                            <th>生日</th>
                            <th>忌日</th>
                            <th>父亲</th>
                            <th>母亲</th>
                            <th>户口地</th>
                            <th>其他信息</th>
                            <th>配偶</th>
                            <th>族谱</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($members as $k => $v): ?>
                            <tr>
                                <td><?=$v->name ?></td>
                                <td><?=\common\models\Enum::getSex()[$v->sex] ?></td>
                                <td><?=$v->borthday ?></td>
                                <td><?=$v->deathday ?></td>
                                <td><?=@$v->father->name ?></td>
                                <td><?=@$v->mother->name ?></td>
                                <td><?=$v->borth_place ?></td>
                                <td><?=$v->info ?></td>
                                <td><?=@$v->spouse->name ?></td>
                                <td><?=$group->title ?></td>
                                <td>
                                    <?=\yii\helpers\Html::a('修改', ['member-update', 'id'=>$v->id], ['class'=>"btn btn-warning btn-xs"]) ?>
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
