<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-9
 * Time: 下午3:16
 */

namespace common\models\db;

/**
 * Class UserRealNameAuth
 * @package common\models\db
 *
 * @property User $user
 */
class UserRealNameAuth extends \common\models\db\base\UserRealNameAuth
{
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}