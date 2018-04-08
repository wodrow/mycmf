<?php

namespace common\models\db\base;

use Yii;

/**
 * This is the model class for table "{{%book}}".
 *
 * @property int $id
 * @property string $name
 * @property string $author
 * @property string $master_editor
 * @property string $press
 * @property int $press_at
 * @property string $price
 * @property int $Revision 版次
 * @property int $total_pages 页数
 * @property int $total_words 字数
 * @property int $book_size 开本
 * @property string $paper_matrix 纸型
 * @property int $printed_at 印刷时间
 * @property string $package 包装
 * @property int $is_suit 是否套装
 * @property string $isbn 国际标准书号
 * @property string $category_id 所属分类
 * @property string $detail 详情
 * @property string $campaign_id 活动
 * @property int $created_at
 * @property string $created_by
 * @property int $updated_at
 * @property string $updated_by
 * @property int $status
 * @property string $shop_id
 *
 * @property Category $category
 * @property Shop $shop
 * @property User $createdBy
 * @property User $updatedBy
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%book}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'author', 'master_editor', 'press', 'press_at', 'price', 'Revision', 'total_pages', 'total_words', 'book_size', 'paper_matrix', 'printed_at', 'package', 'is_suit', 'isbn', 'detail', 'created_at', 'updated_at', 'status', 'shop_id'], 'required'],
            [['press_at', 'Revision', 'total_pages', 'total_words', 'book_size', 'printed_at', 'is_suit', 'created_at', 'updated_at', 'status'], 'default', 'value' => null],
            [['press_at', 'Revision', 'total_pages', 'total_words', 'book_size', 'printed_at', 'is_suit', 'created_at', 'updated_at', 'status'], 'integer'],
            [['price', 'category_id', 'campaign_id', 'created_by', 'updated_by', 'shop_id'], 'number'],
            [['detail'], 'string'],
            [['name', 'author', 'master_editor', 'press'], 'string', 'max' => 200],
            [['paper_matrix', 'package', 'isbn'], 'string', 'max' => 20],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['shop_id'], 'exist', 'skipOnError' => true, 'targetClass' => Shop::className(), 'targetAttribute' => ['shop_id' => 'id']],
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
            'name' => Yii::t('app', 'Name'),
            'author' => Yii::t('app', 'Author'),
            'master_editor' => Yii::t('app', 'Master Editor'),
            'press' => Yii::t('app', 'Press'),
            'press_at' => Yii::t('app', 'Press At'),
            'price' => Yii::t('app', 'Price'),
            'Revision' => Yii::t('app', '版次'),
            'total_pages' => Yii::t('app', '页数'),
            'total_words' => Yii::t('app', '字数'),
            'book_size' => Yii::t('app', '开本'),
            'paper_matrix' => Yii::t('app', '纸型'),
            'printed_at' => Yii::t('app', '印刷时间'),
            'package' => Yii::t('app', '包装'),
            'is_suit' => Yii::t('app', '是否套装'),
            'isbn' => Yii::t('app', '国际标准书号'),
            'category_id' => Yii::t('app', '所属分类'),
            'detail' => Yii::t('app', '详情'),
            'campaign_id' => Yii::t('app', '活动'),
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'status' => Yii::t('app', 'Status'),
            'shop_id' => Yii::t('app', 'Shop ID'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getShop()
    {
        return $this->hasOne(Shop::className(), ['id' => 'shop_id']);
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
}
