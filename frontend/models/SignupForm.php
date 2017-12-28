<?php
namespace frontend\models;

use yii\base\Model;
use common\models\User;

/**
 * Signup form
 */
class SignupForm extends Model
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
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            ['email', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This email address has already been taken.'],
            ['email_code', 'trim'],
            ['email_code', 'required'],
            ['email_code', 'string', 'min'=>32, 'max' => 32],

            ['username', 'trim'],
            ['username', 'required'],
            ['username', 'unique', 'targetClass' => '\common\models\User', 'message' => 'This username has already been taken.'],
            ['username', 'string', 'min' => 2, 'max' => 255],

            ['password', 'required'],
            ['password', 'string', 'min' => 6],

            ['repassword', 'required'],
            ['repassword', 'compare', 'compareAttribute' => 'password'],

            ['code', 'required'],
            ['code', 'captcha'],
        ];
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
        return $user->save() ? $user : null;
    }
}
