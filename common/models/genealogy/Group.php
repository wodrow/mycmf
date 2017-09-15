<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/14/17
 * Time: 9:44 AM
 */

namespace common\models\genealogy;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * Class Group
 * @package common\models\genealogy
 *
 * @property Member[] $members
 */
class Group extends \common\models\genealogy\tables\Group
{
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'title' => '名称',
            'mark' => '标示',
            'info' => '信息',
        ];
    }

    public function rules()
    {
        return [
            [['title', 'mark', 'info'], 'required'],
            [['created_at', 'created_by', 'updated_at', 'updated_by', 'status'], 'integer'],
            [['info'], 'string'],
            [['title'], 'string', 'max' => 50],
            [['mark'], 'string', 'max' => 40],
            [['mark'], 'unique'],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['group_id' => 'id']);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if ($insert){
            $user_group = new UserGroup();
            $user_group->user_id = \Yii::$app->user->id;
            $user_group->group_id = $this->id;
            $user_group->save();
        }
    }
}