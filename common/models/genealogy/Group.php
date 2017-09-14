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
 * @property User[] $users
 */
class Group extends \common\models\genealogy\tables\Group
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['group_id' => 'id']);
    }
}