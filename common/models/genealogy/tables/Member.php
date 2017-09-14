<?php

namespace common\models\genealogy\tables;

use Yii;

/**
 * This is the model class for table "{{%member}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property integer $sex
 * @property string $borthday
 * @property integer $father_id
 * @property integer $mother_id
 * @property string $borth_place
 * @property string $info
 * @property string $group_id
 *
 * @property Group $group
 */
class Member extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%member}}';
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
            [['user_id', 'sex', 'father_id', 'mother_id', 'group_id'], 'integer'],
            [['name', 'group_id'], 'required'],
            [['borthday'], 'safe'],
            [['info'], 'string'],
            [['name'], 'string', 'max' => 20],
            [['borth_place'], 'string', 'max' => 200],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
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
            'name' => Yii::t('app', 'Name'),
            'sex' => Yii::t('app', 'Sex'),
            'borthday' => Yii::t('app', 'Borthday'),
            'father_id' => Yii::t('app', 'Father ID'),
            'mother_id' => Yii::t('app', 'Mother ID'),
            'borth_place' => Yii::t('app', 'Borth Place'),
            'info' => Yii::t('app', 'Info'),
            'group_id' => Yii::t('app', 'Group ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
}
