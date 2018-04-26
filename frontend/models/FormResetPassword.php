<?php
namespace frontend\models;

use common\components\tools\Security;
use common\models\User;
use yii\base\Model;

class FormResetPassword extends Model
{
    public $email;
    public $email_code;
    public $password;
    public $repassword;
    public $code;
    /**
     * @var User $_user
     */
    private $_user;

    public function attributeLabels()
    {
        return [
            'email' => \Yii::t('app', 'Email'),
            'email_code' => \Yii::t('app', 'Email Code'),
            'password' => \Yii::t('app', 'Password'),
            'repassword' => \Yii::t('app', 'Repassword'),
            'code' => \Yii::t('app', 'Code'),
        ];
    }

    public function rules()
    {
        return [
            ['email_code', 'trim'],
            ['email_code', 'required'],
            ['email_code', 'string', 'min'=>32, 'max' => 32],
            ['email_code', 'ruleCheckEmailCode'],

            ['password', 'required'],
            ['password', 'string', 'min' => 6, 'max' => 18],

            ['repassword', 'required'],
            ['repassword', 'compare', 'compareAttribute' => 'password'],

            ['code', 'required'],
            ['code', 'captcha'],
        ];
    }

    public function ruleCheckEmailCode($attribute, $params)
    {
        if (!$this->getErrors()) {
            if ($email = \Yii::$app->cache->get($this->email_code)){
                $this->email = $email;
                $this->_user = User::findOne(['email'=>$this->email]);
                if (!$this->_user) {
                    $this->addError($attribute, '不存在用户！请先注册。');
                }
            }else{
                $this->addError($attribute, '邮箱校验码错误或过期，你可以重新发送校验码。');
            }
        }
    }

    public function resetPassword()
    {
        if (!$this->validate()) {
            return null;
        }
        $this->_user->setPassword($this->password);
        $this->_user->generateAuthKey();
        $this->_user->tp_pwd = Security::think_encrypt($this->password);
        return $this->_user->save();
    }
}