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
 * @property Files $cardFrontImage
 * @property Files $cardBackImage
 * @property Files $cardFrontAndFaceImage
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
            [['user_id', 'name', 'id_card_number', 'id_card_front_image', 'id_card_back_image', 'id_card_front_and_face_image', 'status'], 'required'],
            [['user_id', 'id_card_front_image', 'id_card_back_image', 'id_card_front_and_face_image', 'status'], 'integer'],
            [['auth_back_msg'], 'string'],
            [['name'], 'string', 'max' => 20],
            [['id_card_number'], 'string', 'max' => 18],
            [['user_id'], 'unique'],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['id_card_front_image'], 'exist', 'skipOnError' => true, 'targetClass' => Files::class, 'targetAttribute' => ['id_card_front_image' => 'id']],
            [['id_card_back_image'], 'exist', 'skipOnError' => true, 'targetClass' => Files::class, 'targetAttribute' => ['id_card_back_image' => 'id']],
            [['id_card_front_and_face_image'], 'exist', 'skipOnError' => true, 'targetClass' => Files::class, 'targetAttribute' => ['id_card_front_and_face_image' => 'id']],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($insert){}else{
                $old = static::findOne($this->id);
                if ($old->cardFrontImage&&$this->id_card_front_image!=$old->id_card_front_image){
                    $old->cardFrontImage->delete();
                }
                if ($old->cardBackImage&&$this->id_card_back_image!=$old->id_card_back_image){
                    $old->cardBackImage->delete();
                }
                if ($old->cardFrontAndFaceImage&&$this->id_card_front_and_face_image!=$old->id_card_front_and_face_image){
                    $old->cardFrontAndFaceImage->delete();
                }
            }
            return true;
        } else {
            return false;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCardFrontImage()
    {
        return $this->hasOne(Files::class, ['id' => 'id_card_front_image']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCardBackImage()
    {
        return $this->hasOne(Files::class, ['id' => 'id_card_back_image']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCardFrontAndFaceImage()
    {
        return $this->hasOne(Files::class, ['id' => 'id_card_front_and_face_image']);
    }
}