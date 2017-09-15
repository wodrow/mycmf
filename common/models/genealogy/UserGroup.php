<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/14/17
 * Time: 3:36 PM
 */

namespace common\models\genealogy;


use common\models\User;
use yii\behaviors\TimestampBehavior;

class UserGroup extends \common\models\genealogy\tables\UserGroup
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'join_at',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    public function rules()
    {
        return [
            [['user_id', 'group_id'], 'required'],
            [['user_id', 'group_id', 'join_at'], 'integer'],
            [['user_id', 'group_id'], 'unique', 'targetAttribute' => ['user_id', 'group_id'], 'message' => 'The combination of User ID and Group ID has already been taken.'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }
}