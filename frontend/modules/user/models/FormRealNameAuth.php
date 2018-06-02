<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-9
 * Time: 下午2:53
 */

namespace frontend\modules\user\models;



use common\models\db\UserRealNameAuth;

/**
 * Class FormRealNameAuth
 * @package frontend\modules\user\models
 *
 * @property UserRealNameAuth $userRealNameAuth
 */
class FormRealNameAuth extends UserRealNameAuth
{
//    public $name, $id_card_no, $id_card_front_image, $id_card_back_image, $id_card_front_and_face_image;

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRealNameAuth()
    {
        return $this->hasOne(UserRealNameAuth::class, ['user_id' => 'id']);
    }
}