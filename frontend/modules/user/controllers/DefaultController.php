<?php

namespace frontend\modules\user\controllers;

use common\models\db\User;
use common\models\db\UserRealNameAuth;
use yii\base\ErrorException;
use yii\web\Controller;

/**
 * Default controller for the `user` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionRealNameAuth()
    {
        $real_name_auth = \Yii::$app->user->identity->userRealNameAuth;
        if ($real_name_auth){
            if ($real_name_auth->status == User::REAL_NAME_AUTH_STATUS_NOT_HAVE){
                $real_name_auth->status = User::REAL_NAME_AUTH_STATUS_SEND;
                $real_name_auth->save();
            }
            $model = $real_name_auth;
        }else{
            $model = new UserRealNameAuth();
            $model->user_id = \Yii::$app->user->id;
        }
        return $this->render('real-name-auth', [
            'model' => $model,
        ]);
    }
}
