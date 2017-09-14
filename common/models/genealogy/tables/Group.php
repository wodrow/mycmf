<?php

namespace common\models\genealogy\tables;

use Yii;

/**
 * This is the model class for table "{{%group}}".
 *
 * @property string $id
 * @property string $title
 * @property string $mark
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * @property integer $status
 * @property string $info
 *
 * @property User[] $users
 */
class Group extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%group}}';
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
            [['title', 'mark', 'created_at', 'created_by', 'updated_at', 'updated_by', 'info'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'status'], 'integer'],
            [['info'], 'string'],
            [['title'], 'string', 'max' => 50],
            [['mark'], 'string', 'max' => 40],
            [['mark'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'mark' => Yii::t('app', 'Mark'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
            'info' => Yii::t('app', 'Info'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['group_id' => 'id']);
    }
}
