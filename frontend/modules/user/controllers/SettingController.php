<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/13/17
 * Time: 11:24 AM
 */

namespace frontend\modules\user\controllers;


use common\widgets\wodrow\avatar\CropAction;
use frontend\modules\user\models\FormResetPassword;
use yii\web\Controller;

class SettingController extends Controller
{
    public function actions()
    {
        return [
            'crop'=>[
                'class' => CropAction::className(),
                'config'=>[
                    'bigImageWidth' => '200',     //大图默认宽度
                    'bigImageHeight' => '200',    //大图默认高度
                    'middleImageWidth'=> '100',   //中图默认宽度
                    'middleImageHeight'=> '100',  //中图图默认高度
                    'smallImageWidth' => '50',    //小图默认宽度
                    'smallImageHeight' => '50',   //小图默认高度

                    //头像上传目录（注：目录前不能加"/"）
                    'uploadPath' => 'uploads/avatar',
                ],
                'baseUrl' => '@wurl/uploads/avatar',//访问目录
                'basePath' => '@wroot/uploads/avatar',//磁盘目录
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
}