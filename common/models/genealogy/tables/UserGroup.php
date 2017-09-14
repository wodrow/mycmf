<?php

namespace common\models\genealogy\tables;

use common\models\User;
use Yii;

/**
 * This is the model class for table "{{%user_group}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $group_id
 * @property integer $join_at
 *
 * @property Group $group
 * @property User $user
 */
class UserGroup extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_group}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_genealogy');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id', 'group_id', 'join_at'], 'required'],
            [['user_id', 'group_id', 'join_at'], 'integer'],
            [['user_id', 'group_id'], 'unique', 'targetAttribute' => ['user_id', 'group_id'], 'message' => 'The combination of User ID and Group ID has already been taken.'],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'group_id' => Yii::t('app', 'Group ID'),
            'join_at' => Yii::t('app', 'Join At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
