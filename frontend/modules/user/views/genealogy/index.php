<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\user\models\genealogy\UserGroup[] $user_groups
 * @var \yii\data\Pagination $pages
 */
$this->title = "我的族谱";
$this->params['breadcrumbs'][] = \yii\helpers\Html::a('用户中心', ['/user']);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-genealogy-index">
    <h4>我的族谱</h4>
    <div class="row">
        <div class="col-lg-12">
            <div class="items">
                <table class="table table-border">
                    <thead>
                    <tr>
                        <th>名称</th>
                        <th>标示</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php foreach($user_groups as $k => $v):$v = $v->group; ?>
                        <tr>
                            <td><?=\yii\helpers\Html::a($v->title, ['group-view', 'id' => $v->id], ['title' => $v->info]) ?></td>
                            <td><?=$v->mark ?></td>
                            <td>
                                <?=\yii\helpers\Html::a('浏览谱图', ['/user/genealogy/map-view', 'id'=>$v->id], ['class'=>"btn btn-info btn-xs", 'target'=>"_blank"]) ?>
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
        <div class="col-lg-12">
            <?=\yii\helpers\Html::a('寻找并加入族谱', ['group-search'], ['class'=>"btn btn-primary"]) ?>
        </div>
    </div>
</div>