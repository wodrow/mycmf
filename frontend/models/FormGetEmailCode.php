<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-12-29
 * Time: 上午10:49
 */

namespace frontend\models;


use yii\base\Model;

class FormGetEmailCode extends Model
{
    public $email;

    public function attributeLabels()
    {
        return [
            'email' => \Yii::t('app', 'Email'),
        ];
    }

    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => \Yii::t('app', 'This email address has already been taken.')],
        ];
    }

    public function sendCode()
    {
        $email_code = \Yii::$app->security->generateRandomString();
        $key = $this->email."-signup-code";
        if ($x = \Yii::$app->cache->get($key)){
            \Yii::$app->cache->delete($key);
            \Yii::$app->cache->delete($x);
        }
        \Yii::$app->cache->set($key, $email_code, 3600*24);
        \Yii::$app->cache->set($email_code, $this->email, 3600*24);
        $html = "邮箱校验码是:<br>".\Yii::$app->cache->get($key)."<br>24小时内有效";
        $mail = \Yii::$app->mailer->compose();
        $mail->setTo($this->email); //要发送给那个人的邮箱
        $mail->setSubject("邮箱注册码"); //邮件主题
//        $mail->setTextBody($text); //发布纯文字文本
        $mail->setHtmlBody($html); //发送的消息内容
        return $mail->send();
    }
}