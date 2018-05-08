<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-8
 * Time: 下午1:28
 */

use common\rewrite\kartik\widgets\SideNav;
use kartik\helpers\Html;
use common\models\User;

$this->beginContent('@frontend/views/layouts/base.php');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4 user-layout-sidebar">
            <?=SideNav::widget([
                'type' => SideNav::TYPE_DEFAULT,
                'heading' => '设置菜单',
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
                        'url' => ['/user/setting/change-avatar'],
                        'label' => '修改头像',
                        'icon' => 'info-sign' // This is a bootstrap icon name
                    ],
                    [
                        'url' => ['/user/setting/reset-password'],
                        'label' => '重置密码',
                        'icon' => 'info-sign' // This is a bootstrap icon name
                    ]
                ],
            ]) ?>
            <?php
            if (Yii::$app->user->identity->is_seller):
                echo SideNav::widget([
                    'type' => SideNav::TYPE_DEFAULT,
                    'heading' => '卖家服务',
                    'items' => [
                        [
                            'url' => ['/user/default/index'],
                            'label' => '用户中心',
                            'icon' => 'home' // This is a bootstrap icon name
                        ],
                    ],
                ]);
            else:
                echo Html::a('成为卖家', ['/user/seller/become-seller'], ['class' => "btn btn-info"]);
            endif;
            if (Yii::$app->user->identity->real_name_auth_status != User::REAL_NAME_AUTH_STATUS_SUCCESS):
                echo Html::a('实名认证', ['/user/default/real-name-auth'], ['class' => "btn btn-info"]);
            endif;
            ?>
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
