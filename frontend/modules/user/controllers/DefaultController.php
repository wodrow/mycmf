<?php

namespace frontend\modules\user\controllers;

use common\components\budget\Smms;
use common\models\db\Budget;
use common\models\db\Files;
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

    public function actionRealNameCheckWebuploaderUpload()
    {
        \Yii::$app->response->format=Response::FORMAT_JSON;
        $r = [
            'code'=>1,
            'msg'=>'error',
        ];
        $file = new Files();
        $budget = Budget::findOne(['name'=>Smms::NAME]);
        $file->budget_id = $budget->id;
        $file->type = $file::TYPE_IMAGE;
        $file->status = $file::STATUS_ACTIVE;
        $file->func_for = $file::FUNC_FOR_REAL_NAME_CHECK;
        $data = $budget->operator->uploadLocalFile($_FILES['file']['tmp_name']);
        $file->initDataByBudgetResp($data);
        if ($file->save()){
            $r['code'] = 0;
            $r['url'] = $file->url;
            $r['attachment'] = $file->id;
        }else{
            $r['msg'] = var_export($file->errors, true);
        }
        return $r;
    }

    /**
     * 实名认证
     */
    public function actionRealNameAuth()
    {
        $model = \Yii::$app->user->identity->userRealNameAuth;
        if ($model){
            if ($model->status != User::REAL_NAME_AUTH_STATUS_SUCCESS){
                $model->status = User::REAL_NAME_AUTH_STATUS_SEND;
            }
        }else{
            $model = new UserRealNameAuth();
            $model->user_id = \Yii::$app->user->id;
            $model->status = User::REAL_NAME_AUTH_STATUS_SEND;
        }
        if ($model->load(\Yii::$app->request->post())&&$model->validate()){
            if ($model->save()){
                \Yii::$app->session->setFlash('success', "提交成功,请耐心等待结果");
            }
        }
        return $this->render('real-name-auth', [
            'model' => $model,
        ]);
    }
}
