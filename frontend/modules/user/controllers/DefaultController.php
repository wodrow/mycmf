<?php

namespace frontend\modules\user\controllers;

use common\models\db\User;
use common\models\db\UserRealNameAuth;
use yii\web\Controller;
use yii\web\Response;

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

    public function actionWebuploaderUpload()
    {
        // 错误时
//        {"code": 1, "msg": "error"}

// 正确时， 其中 attachment 指的是保存在数据库中的路径，url 是该图片在web可访问的地址
//        {"code": 0, "url": "http://domain/图片地址", "attachment": "图片地址"}
        \Yii::$app->response->format=Response::FORMAT_JSON;
        $content = file_get_contents($_FILES['file']['tmp_name']);
        file_put_contents(\Yii::getAlias('@wroot/storge/tmp/').$_FILES['file']['name'], $content);
        return [
            'code'=>1,
            'msg'=>'error',
        ];
    }

    /**
     * 实名认证
     */
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
        if ($model->load(\Yii::$app->request->post())){
            var_dump($model->toArray());exit;
        }
        return $this->render('real-name-auth', [
            'model' => $model,
        ]);
    }
}
