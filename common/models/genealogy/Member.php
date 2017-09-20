<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/14/17
 * Time: 9:01 AM
 */

namespace common\models\genealogy;

/**
 * Class User
 * @package common\models\genealogy
 *
 * @property Group $group
 * @property Member $father
 * @property Member $mother
 * @property Member $spouse
 */
class Member extends \common\models\genealogy\tables\Member
{
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
        return $this->hasOne(self::className(), ['id' => 'father_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMother()
    {
        return $this->hasOne(self::className(), ['id' => 'mother_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSpouse()
    {
        return $this->hasOne(Member::className(), ['id' => 'spouse_id']);
    }

    public function attributeLabels()
    {
        return [
            'name' => "姓名",
            'sex' => "性别",
            'borthday' => "生日",
            'deathday' => "忌日",
            'father_id' => "父亲",
            'mother_id' => "母亲",
            'spouse_id' => "配偶",
            'borth_place' => "户口地",
            'info' => "个人介绍",
        ];
    }

    public function spouseEdit()
    {
        if ($this->spouse_id){
            $spouse = $this->spouse;
            $spouse->spouse_id = $this->id;
            $spouse->save();
        }else{
            $spouse = self::findOne(['spouse_id'=>$this->id]);
            if ($spouse){
                $spouse->spouse_id = null;
                $spouse->save();
            }
        }
    }
}