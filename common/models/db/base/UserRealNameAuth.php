<?php

namespace common\models\db\base;

use Yii;

/**
 * This is the model class for table "{{%user_real_name_auth}}".
 *
 * @property string $id
 * @property string $user_id
 * @property string $name
 * @property string $id_card_number
 * @property string $id_card_front_image
 * @property string $id_card_back_image
 * @property string $id_card_front_and_face_image 半身和身份证正面照
 * @property string $auth_back_msg 实名认证失败返回信息
 * @property int $status
 *
 * @property User $user
 */
class UserRealNameAuth extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user_real_name_auth}}';
    }

    /**
     * @inheritdoc
     */
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'user_id' => Yii::t('app', 'User ID'),
            'name' => Yii::t('app', 'Name'),
            'id_card_number' => Yii::t('app', 'Id Card Number'),
            'id_card_front_image' => Yii::t('app', 'Id Card Front Image'),
            'id_card_back_image' => Yii::t('app', 'Id Card Back Image'),
            'id_card_front_and_face_image' => Yii::t('app', '半身和身份证正面照'),
            'auth_back_msg' => Yii::t('app', '实名认证失败返回信息'),
            'status' => Yii::t('app', 'Status'),
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
