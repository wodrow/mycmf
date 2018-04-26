<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-12-27
 * Time: 上午10:24
 */

namespace api\modules\other\controllers;


use deepziyu\yii\rest\Controller;
use yii\base\ErrorException;

class DefaultController extends Controller
{
    /**
     * 获取用户的令牌和密钥
     * @desc 获取用户的令牌和密钥
     * @param string $username 用户名
     * @param string $password 密码
     * @param string $code 校验码
     * @return string $token 令牌
     * @return string $key 密钥
     */
    public function actionGetTokenAndKey($username, $password, $code)
    {
        if ($code!='1234'){
            throw new ErrorException('验证码错误', 1004);
        }
        $user = User::findOne(['username' => $username]);
        if ($user->status!=User::STATUS_ACTIVE){
            throw new ErrorException('用户异常', 1011);
        }
        if ($user->auth_key!=\Yii::$app->security->validatePassword($password, $user->password_hash)){
            throw new ErrorException('用户名或密码错误', 1005);
        }
        return [
            'token' => $user->token,
            'key' => $user->sign_key,
        ];
    }
}