<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-9
 * Time: 下午12:51
 */
?>


<?php leoshtika\bootstrap\NavSidebar::widget([
    'items' => [
        [
            'url' => ['/user'],
            'label' => 'Home',
            'icon' => 'home' // This is a bootstrap icon name
        ],
        [
            'url' => ['/user/setting'],
            'label' => 'about',
            'icon' => 'info-sign' // This is a bootstrap icon name
        ],
    ],
]) ?>
<div class="panel panel-default">
    <div class="panel-heading">
        <i class="fa fa-th fa-fw"></i> 个人信息
    </div>
    <!-- /.panel-heading -->
    <div class="panel-body">
        <div class="list-group">
            <li class="list-group-item"><?=Yii::$app->user->identity->username ?></li>
            <li class="list-group-item">
                <i class="fa fa-circle-thin"></i> 等级
                <span class="badge"><?=Yii::$app->user->identity->level ?></span>
            </li>
            <li class="list-group-item">
                <i class="fa fa-circle-thin"></i> 积分
                <span class="badge"><?=Yii::$app->user->identity->integer ?></span>
            </li>
        </div>
        <!-- /.list-group -->
        <div class="btn-group btn-group-justified" role="group" aria-label="...">
            <div class="btn-group" role="group">
                <a class="btn btn-default" href="/story/default/create">发布文章</a>                            </div>
        </div>
    </div>
    <!-- /.panel-body -->
</div>
