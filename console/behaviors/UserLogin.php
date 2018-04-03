<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-3
 * Time: 上午11:06
 */

namespace console\behaviors;


use common\config\Env;
use common\models\User;
use yii\base\ActionFilter;
use yii\base\ErrorException;

class UserLogin extends ActionFilter
{
    public function beforeAction($action)
    {
        $username = Env::CONSOLE_USERNAME;
        $user = User::findByUsername($username);
        if (!$user){
            throw new ErrorException("没有找到用户");
        }
        \Yii::$app->user->loginByAccessToken($user->token);
        return parent::beforeAction($action);
    }
}