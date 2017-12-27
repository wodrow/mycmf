<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 3/30/17
 * Time: 10:51 AM
 */

namespace api\controllers;


use api\models\User;
use common\components\tools\Tools;
use deepziyu\yii\rest\Controller;
use yii\base\ErrorException;

class SiteController extends Controller
{
    /*public function actionTest()
    {
        echo 132;
    }*/

    /**
     * api使用用户注册
     * @desc api使用用户注册
     * @param string $username 用户名
     * @param string $phone 手机号
     * @param string $email 邮箱
     * @param string $password 密码
     * @param string $code 校验码
     * @param int $user_type 用户类型(默认10:个人, 11:企业)
     * @param string $company 公司
     * @return array $userinfo 新用户信息
     */
    /*public function actionSignup($username, $phone, $email, $password, $code, $user_type=User::USER_TYPE_PERSONAL, $company = null)
    {
        if ($code!='1234'){
            throw new ErrorException('验证码错误', 1004);
        }
        $model = new User();
        $data = [
            'username'=>$username,
            'phone'=>$phone,
            'email'=>$email,
            'password_hash'=>\Yii::$app->security->generatePasswordHash($password),
            'auth_key'=>\Yii::$app->security->generateRandomString(),
            'user_type'=>$user_type,
            'company'=>$company,
            'status'=>User::STATUS_ACTIVE,
            'token'=>md5(\Yii::$app->security->generateRandomString().time()),
            'sign_key'=>\Yii::$app->security->generateRandomString(),
        ];
        if ($model->load(['formName'=>$data],'formName')&&$model->validate()){
            $model->save();
            return $model->toArray();
        }else{
            throw new ErrorException(Tools::makeModelGetErrorsToStringAndGetIt($model), 1010);
        }
    }*/

    /*public function actionGetCodeByEmail()
    {
        #
    }

    public function actionLogin()
    {
        #
    }

    public function actionUpdateToken()
    {
        #
    }

    public function actionUpdateKey()
    {
        #
    }*/

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

    /**
     * 认证测试
     * @desc 认证测试
     * @param string $username 用户名
     * @return bool $bool 是否认证成功
     */
    public function actionTestAuth($username)
    {
        if ($username == \Yii::$app->user->identity->username){
            $bool = true;
        }else{
            $bool = false;
        }
        return [
            'bool' => $bool,
        ];
    }
}