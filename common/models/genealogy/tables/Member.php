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
 * @property string $deathday
 * @property string $father_id
 * @property string $mother_id
 * @property string $borth_place
 * @property string $info
 * @property string $group_id
 * @property string $spouse_id
 *
 * @property Member $spouse
 * @property Member $member
 * @property Group $group
 * @property Member $father
 * @property Member[] $members
 * @property Member $mother
 * @property Member[] $members0
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
            [['user_id', 'sex', 'father_id', 'mother_id', 'group_id', 'spouse_id'], 'integer'],
            [['name', 'group_id'], 'required'],
            [['borthday', 'deathday'], 'safe'],
            [['info'], 'string'],
            [['name'], 'string', 'max' => 20],
            [['borth_place'], 'string', 'max' => 200],
            [['spouse_id'], 'unique'],
            [['spouse_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['spouse_id' => 'id']],
            [['group_id'], 'exist', 'skipOnError' => true, 'targetClass' => Group::className(), 'targetAttribute' => ['group_id' => 'id']],
            [['father_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['father_id' => 'id']],
            [['mother_id'], 'exist', 'skipOnError' => true, 'targetClass' => Member::className(), 'targetAttribute' => ['mother_id' => 'id']],
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
            'deathday' => Yii::t('app', 'Deathday'),
            'father_id' => Yii::t('app', 'Father ID'),
            'mother_id' => Yii::t('app', 'Mother ID'),
            'borth_place' => Yii::t('app', 'Borth Place'),
            'info' => Yii::t('app', 'Info'),
            'group_id' => Yii::t('app', 'Group ID'),
            'spouse_id' => Yii::t('app', 'Spouse ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpouse()
    {
        return $this->hasOne(Member::className(), ['id' => 'spouse_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMember()
    {
        return $this->hasOne(Member::className(), ['spouse_id' => 'id']);
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
    public function getFather()
    {
        return $this->hasOne(Member::className(), ['id' => 'father_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['father_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMother()
    {
        return $this->hasOne(Member::className(), ['id' => 'mother_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers0()
    {
        return $this->hasMany(Member::className(), ['mother_id' => 'id']);
    }
}
