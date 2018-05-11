<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-9
 * Time: 下午3:16
 */

namespace common\models\db;

use Yii;
/**
 * Class UserRealNameAuth
 * @package common\models\db
 *
 * @property User $user
 */
class UserRealNameAuth extends \common\models\db\base\UserRealNameAuth
{
    public function attributeLabels()
    {
        return [
            'name' => "真实姓名",
            'id_card_number' => Yii::t('app', '身份证号'),
            'id_card_front_image' => Yii::t('app', '身份证正面照片'),
            'id_card_back_image' => Yii::t('app', '身份证反面照片'),
            'id_card_front_and_face_image' => Yii::t('app', '半身和身份证正面照'),
        ];
    }

    public function rules()
    {
        return [
            [['user_id', 'name', 'id_card_number', 'id_card_front_and_face_image', 'status'], 'required'],
            [['user_id', 'status'], 'integer'],
            [['auth_back_msg'], 'string'],
            [['name'], 'string', 'max' => 20],
            [['id_card_number'], 'string', 'max' => 18],
            [['id_card_front_image', 'id_card_back_image', 'id_card_front_and_face_image'], 'string', 'max' => 200],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}