<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-8
 * Time: 下午1:28
 */
$this->beginContent('@frontend/views/layouts/base.php');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 user-layout-sidebar">
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
            <?=\common\rewrite\kartik\widgets\SideNav::widget([
                'type' => \common\rewrite\kartik\widgets\SideNav::TYPE_DEFAULT,
                'heading' => '菜单',
                'items' => [
                    [
                        'url' => ['/user/default/index'],
                        'label' => '用户中心',
                        'icon' => 'home' // This is a bootstrap icon name
                    ],
                    [
                        'url' => ['/user/setting/index'],
                        'label' => '账号设置',
                        'icon' => 'info-sign' // This is a bootstrap icon name
                    ],
                    [
                        'url' => ['/user/setting/reset-password'],
                        'label' => '重置密码',
                        'icon' => 'info-sign' // This is a bootstrap icon name
                    ]
                ],
            ]) ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8">
            <?= \yii\widgets\Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'encodeLabels' => false,
            ]) ?>
            <?= \common\widgets\Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endContent() ?>
