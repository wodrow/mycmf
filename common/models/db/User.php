<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $token
 * @property string $key
 * @property string $tp_pwd
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 */
class User extends \common\models\db\base\User
{
    const IS_SELLER_FALSE = 0;
    const IS_SELLER_TRUE = 1;
    const REAL_NAME_AUTH_STATUS_NOT_HAVE = 0;
    const REAL_NAME_AUTH_STATUS_DRAFT = 1;
    const REAL_NAME_AUTH_STATUS_SEND = 2;
    const REAL_NAME_AUTH_STATUS_FAILED = 3;
    const REAL_NAME_AUTH_STATUS_SUCCESS = 4;

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('{{%auth_assignment}}', ['user_id' => 'id']);
    }
}
