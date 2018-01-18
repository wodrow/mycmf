<?php
/**
 * @var \yii\web\View $this
 */
$this->title = "账号设置";
$this->params['breadcrumbs'][] = \kartik\helpers\Html::a('用户中心', ['/user']);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-setting-index">
    <div class="row">
        <div class="col-lg-12">
            <?=\kartik\helpers\Html::a('重置密码', ['reset-password']) ?>
        </div>
    </div>
</div>
