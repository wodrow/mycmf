<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\authclient\widgets\AuthChoice;

$this->title = Yii::t('app', 'Login');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>
    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>
                <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'code')->widget(\yii\captcha\Captcha::className()) ?>
                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div style="color:#999;margin:1em 0">
                    如果你忘记了密码，你可以 <?= Html::a('重置密码', ['site/reset-password']) ?>.
                </div>

                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Login'), ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-5">
            <h5 style="margin-left: 35px">其他登录方式</h5>
            <?php $authAuthChoice = AuthChoice::begin([
                'baseAuthUrl' => ['site/auth'],
                'popupMode' => true,
            ]); ?>
            <ul class="auth-clients">
                <?php foreach ($authAuthChoice->getClients() as $client): ?>
                    <li><?= $authAuthChoice->clientLink($client,'',[ 'class' => 'auth-icon fa fa-2x fa-'.$client->getId()]) ?></li>
                <?php endforeach; ?>
            </ul>
            <?php AuthChoice::end(); ?>
        </div>
    </div>
</div>
