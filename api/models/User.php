<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 3/30/17
 * Time: 3:16 PM
 */

namespace api\models;


class User extends \common\models\User
{
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'phone', 'user_type'], 'required'],
            [['status', 'created_at', 'updated_at', 'user_type'], 'integer'],
            [['username', 'password_hash', 'password_reset_token', 'email'], 'string', 'max' => 255],
            [['auth_key', 'token', 'sign_key'], 'string', 'max' => 32],
            [['phone'], 'string', 'max' => 11],
            [['company'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['phone'], 'unique'],
            [['password_reset_token'], 'unique'],
            [['token'], 'unique'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'auth_key' => 'Auth Key',
            'password_hash' => 'Password Hash',
            'password_reset_token' => 'Password Reset Token',
            'email' => 'Email',
            'status' => 'Status',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
            'token' => 'Token',
            'sign_key' => 'Sign Key',
            'phone' => 'Phone',
            'user_type' => 'User Type',
            'company' => 'Company',
        ];
    }
}