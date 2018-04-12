<?php
namespace frontend\models;

use common\components\tools\Security;
use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class FormSignup extends Model
{
    public $email;
    public $email_code;
    public $username;
    public $password;
    public $repassword;
    public $code;

    public function attributeLabels()
    {
        return [
            'email' => \Yii::t('app', 'Email'),
            'email_code' => \Yii::t('app', 'Email Code'),
            'username' => \Yii::t('app', 'Username'),
            'password' => \Yii::t('app', 'Password'),
            'repassword' => \Yii::t('app', 'Repassword'),
            'code' => \Yii::t('app', 'Code'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
//            ['email', 'trim'],
//            ['email', 'required'],
//            ['email', 'email'],
//            ['email', 'string', 'max' => 255],
//            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['email_code', 'trim'],
            ['email_code', 'required'],
            ['email_code', 'string', 'min'=>32, 'max' => 32],
            ['email_code', 'ruleCheckEmailCode'],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

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
            }else{
                $this->addError($attribute, '邮箱校验码错误或过期，你可以重新发送校验码。');
            }
        }
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function signup()
    {
        if (!$this->validate()) {
            return null;
        }
        $user = new User();
        $user->username = $this->username;
        $user->email = $this->email;
        $user->setPassword($this->password);
        $user->generateAuthKey();
        $user->tp_pwd = Security::think_encrypt($this->password);
        $user->token = $this->generateToken();
        $user->key = \Yii::$app->security->generateRandomString(50);
        return $user->save() ? $user : null;
    }

    public function generateToken()
    {
        $s = \Yii::$app->security->generateRandomString(50);
        if (User::findOne(['token' => $s])){
            return $this->generateToken();
        }else{
            return $s;
        }
    }
}
