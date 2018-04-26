<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\user\models\FormResetPassword $resetPasswordForm
 */
$this->title = "重置密码";
$this->params['breadcrumbs'][] = \kartik\helpers\Html::a('用户中心', ['/user']);
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-default-reset-password">
    <div class="row">
        <div class="col-sm-12">
            <?php $form = \yii\bootstrap\ActiveForm::begin(); ?>
            <?=$form->field($resetPasswordForm, 'oldpassword')->passwordInput(); ?>
            <?=$form->field($resetPasswordForm, 'newpassword')->passwordInput(); ?>
            <?=$form->field($resetPasswordForm, 'renewpassword')->passwordInput(); ?>
            <?=\yii\helpers\Html::submitButton("重置密码", ['class'=>"btn btn-primary"]) ?>
            <?php \yii\bootstrap\ActiveForm::end(); ?>
        </div>
    </div>
</div>