<?php

namespace common\models\db\base;

use Yii;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property int $status
 * @property int $created_at
 * @property int $updated_at
 * @property string $token TOKEN
 * @property string $key TOKEN钥匙
 * @property string $tp_pwd
 * @property int $is_seller 是否为卖家
 * @property string $level 等级
 * @property string $score 积分
 * @property int $real_name_auth_status 实名认证状态
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 * @property Book[] $books
 * @property Book[] $books0
 * @property Category[] $categories
 * @property Category[] $categories0
 * @property Compaign[] $compaigns
 * @property Compaign[] $compaigns0
 * @property Document[] $documents
 * @property Document[] $documents0
 * @property Shop[] $shops
 * @property Shop[] $shops0
 * @property Shop[] $shops1
 * @property Tag[] $tags
 * @property Tag[] $tags0
 * @property UserRealNameAuth $userRealNameAuth
 */
class User extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%user}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'auth_key', 'password_hash', 'email', 'status', 'created_at', 'updated_at', 'token', 'key', 'tp_pwd'], 'required'],
            [['status', 'created_at', 'updated_at', 'is_seller', 'level', 'score', 'real_name_auth_status'], 'integer'],
            [['username'], 'string', 'max' => 20],
            [['auth_key'], 'string', 'max' => 32],
            [['password_hash', 'email', 'tp_pwd'], 'string', 'max' => 255],
            [['token', 'key'], 'string', 'max' => 50],
            [['username'], 'unique'],
            [['email'], 'unique'],
            [['token'], 'unique'],
            [['key'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'Username'),
            'auth_key' => Yii::t('app', 'Auth Key'),
            'password_hash' => Yii::t('app', 'Password Hash'),
            'email' => Yii::t('app', 'Email'),
            'status' => Yii::t('app', 'Status'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'token' => Yii::t('app', 'TOKEN'),
            'key' => Yii::t('app', 'TOKEN钥匙'),
            'tp_pwd' => Yii::t('app', 'Tp Pwd'),
            'is_seller' => Yii::t('app', '是否为卖家'),
            'level' => Yii::t('app', '等级'),
            'score' => Yii::t('app', '积分'),
            'real_name_auth_status' => Yii::t('app', '实名认证状态'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('{{%auth_assignment}}', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks0()
    {
        return $this->hasMany(Book::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories()
    {
        return $this->hasMany(Category::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategories0()
    {
        return $this->hasMany(Category::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompaigns()
    {
        return $this->hasMany(Compaign::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCompaigns0()
    {
        return $this->hasMany(Compaign::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments0()
    {
        return $this->hasMany(Document::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShops()
    {
        return $this->hasMany(Shop::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShops0()
    {
        return $this->hasMany(Shop::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShops1()
    {
        return $this->hasMany(Shop::className(), ['owner_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['created_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags0()
    {
        return $this->hasMany(Tag::className(), ['updated_by' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRealNameAuth()
    {
        return $this->hasOne(UserRealNameAuth::className(), ['user_id' => 'id']);
    }
}
