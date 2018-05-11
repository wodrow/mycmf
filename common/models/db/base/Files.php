<?php

namespace common\models\db\base;

use Yii;

/**
 * This is the model class for table "{{%files}}".
 *
 * @property string $id
 * @property int $type
 * @property string $url
 * @property string $delete_url
 * @property string $filename
 * @property int $created_at
 * @property int $updated_at
 * @property string $created_by
 * @property string $updated_by
 * @property int $uploaded_at
 * @property string $uploaded_ip
 * @property int $size
 * @property int $width
 * @property int $height
 * @property string $path
 * @property string $budget_id
 * @property int $status
 * @property string $func_for
 * @property string $storename
 * @property string $hash
 *
 * @property Budget $budget
 * @property User $createdBy
 * @property User $updatedBy
 * @property User[] $users
 * @property UserRealNameAuth[] $userRealNameAuths
 * @property UserRealNameAuth[] $userRealNameAuths0
 * @property UserRealNameAuth[] $userRealNameAuths1
 */
class Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%files}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'url', 'delete_url', 'filename', 'created_at', 'updated_at'], 'required'],
            [['type', 'created_at', 'updated_at', 'created_by', 'updated_by', 'uploaded_at', 'size', 'width', 'height', 'budget_id', 'status'], 'integer'],
            [['url', 'delete_url', 'filename', 'path', 'storename', 'hash'], 'string', 'max' => 200],
            [['uploaded_ip'], 'string', 'max' => 30],
            [['func_for'], 'string', 'max' => 20],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => Budget::className(), 'targetAttribute' => ['budget_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'type' => Yii::t('app', 'Type'),
            'url' => Yii::t('app', 'Url'),
            'delete_url' => Yii::t('app', 'Delete Url'),
            'filename' => Yii::t('app', 'Filename'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'uploaded_at' => Yii::t('app', 'Uploaded At'),
            'uploaded_ip' => Yii::t('app', 'Uploaded Ip'),
            'size' => Yii::t('app', 'Size'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'path' => Yii::t('app', 'Path'),
            'budget_id' => Yii::t('app', 'Budget ID'),
            'status' => Yii::t('app', 'Status'),
            'func_for' => Yii::t('app', 'Func For'),
            'storename' => Yii::t('app', 'Storename'),
            'hash' => Yii::t('app', 'Hash'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudget()
    {
        return $this->hasOne(Budget::className(), ['id' => 'budget_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'updated_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUsers()
    {
        return $this->hasMany(User::className(), ['avatar' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRealNameAuths()
    {
        return $this->hasMany(UserRealNameAuth::className(), ['id_card_front_image' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRealNameAuths0()
    {
        return $this->hasMany(UserRealNameAuth::className(), ['id_card_back_image' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRealNameAuths1()
    {
        return $this->hasMany(UserRealNameAuth::className(), ['id_card_front_and_face_image' => 'id']);
    }
}
