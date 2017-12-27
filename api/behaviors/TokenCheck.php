<?php
namespace api\behaviors;

use yii\base\Exception;
use yii\filters\AccessControl;

class TokenCheck extends AccessControl
{
    public function beforeAction($action)
    {
//        $headers = \Yii::$app->request->headers;
//        $token = $headers->get('token');
//        $timestamp = $headers->get('timestamp');
//        $nonce = $headers->get('nonce');
//        $signature = $headers->get('signature');
//        if (YII_ENV_PROD){
//            if (!$token||!$timestamp||!$nonce||!$signature){
//                throw new Exception("header参数错误,请检查--token:".$token.";timestamp:".$timestamp.";nonce:".$nonce.";signature:".$signature, 1001);
//            }
//            \Yii::$app->user->loginByAccessToken($token);
//            if (!\Yii::$app->user->id){
//                throw new Exception("令牌验证错误", 1002);
//            }
////        echo md5($token.$timestamp.$nonce.\Yii::$app->getUser()->identity->sign_key);exit;
//            if (md5($token.$timestamp.$nonce.\Yii::$app->user->identity->sign_key)!==$signature){
//                throw new Exception("签名错误", 1003);
//            }
//            $tmp_nonces = is_array(\Yii::$app->cache->get('sign_nonce_'.\Yii::$app->user->id))?\Yii::$app->cache->get('sign_nonce_'.\Yii::$app->user->id):[];
//            if (!in_array($nonce, $tmp_nonces)){
//	            $tmp_nonces[] = $nonce;
//                \Yii::$app->cache->set('sign_nonce_'.\Yii::$app->user->id, $tmp_nonces, 3600);
//            }else{
//                throw new Exception("请求随机数重复", 1004);
//            }
//            if(abs(time()-$timestamp)>600){
//                throw new Exception("请求过期或非法", 1005);
//            }
//        }
//        if(YII_ENV_DEV){
//            \Yii::$app->user->loginByAccessToken($token);
//            if (!\Yii::$app->user->id){
//                throw new Exception("令牌验证错误", 1002);
//            }
//        }
//        $user = \Yii::$app->user->identity;
//        if (in_array($user->username, \Yii::$app->params['api_admin_users'])){}else{
//            if (in_array(\Yii::$app->request->pathInfo, $user->allApiRouteArr)){}else{
//                throw new Exception($user->username."无权访问此接口:".\Yii::$app->request->pathInfo, 1006);
//            }
//        }
        return parent::beforeAction($action);
    }
}