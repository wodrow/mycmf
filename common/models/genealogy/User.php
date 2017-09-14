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
class User extends \common\models\genealogy\tables\User
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroup()
    {
        return $this->hasOne(Group::className(), ['id' => 'group_id']);
    }
}