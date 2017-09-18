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

    public function attributeLabels()
    {
        return [
            'name' => "姓名",
            'sex' => "性别",
            'borthday' => "生日",
            'father_id' => "父亲",
            'mother_id' => "母亲",
            'borth_place' => "户口地",
            'info' => "其他信息",
        ];
    }
}