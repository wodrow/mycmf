<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/14/17
 * Time: 9:44 AM
 */

namespace common\models\genealogy;

/**
 * Class Group
 * @package common\models\genealogy
 *
 * @property Member[] $members
 */
class Group extends \common\models\genealogy\tables\Group
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMembers()
    {
        return $this->hasMany(Member::className(), ['group_id' => 'id']);
    }
}