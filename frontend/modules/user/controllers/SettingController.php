<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/13/17
 * Time: 11:24 AM
 */

namespace frontend\modules\user\controllers;


use frontend\modules\user\models\FormChangeAvatar;
use frontend\modules\user\models\FormResetPassword;
use yii\web\Controller;

class SettingController extends Controller
{
    public function actions()
    {
        return [
            'uploadAvatar' => [
                'class' => 'budyaga\cropper\actions\UploadAction',
                'url' => \Yii::getAlias('@wurl/storage/tmp'),
                'path' => \Yii::getAlias('@wroot/storage/tmp'),
            ]
        ];
    }

    public function actionIndex()
    {
        $model = \Yii::$app->user->identity;
        return $this->render('index', [
            'model' => $model,
        ]);
    }

    /**
     * 重置密码
     * @return string
     */
    public function actionResetPassword()
    {
        $resetPasswordForm = new FormResetPassword();
        if ($resetPasswordForm->load(\Yii::$app->request->post())&&$resetPasswordForm->validate()){
            if ($resetPasswordForm->resetPassword()){
                \Yii::$app->session->setFlash('success', '重置成功!');
            }else{
                \Yii::$app->session->setFlash('success', '重置失败!');
            }
        }
        return $this->render('reset-password', [
            'resetPasswordForm' => $resetPasswordForm,
        ]);
    }

    /**
     * 重置头像
     * @return string
     */
    public function actionChangeAvatar()
    {
        $model = new FormChangeAvatar();
        if ($model->load(\Yii::$app->request->post())){
            \Yii::$app->user->identity->saveAvatar($model->avatar);
        }
        return $this->render('change-avatar', [
            'model' => $model,
        ]);
    }
}