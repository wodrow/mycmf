<?php

namespace common\models\db\base;

use Yii;

/**
 * This is the model class for table "{{%document}}".
 *
 * @property string $id
 * @property string $name 名称
 * @property string $title 标题
 * @property int $type 类型
 * @property string $created_by
 * @property int $created_at
 * @property string $updated_by
 * @property int $updated_at
 * @property int $status 状态
 * @property string $content 主体内容
 * @property string $thumb_main 主缩略图
 * @property string $reprint_from 转载于
 * @property int $abs_sort 固定排序
 *
 * @property User $createdBy
 * @property User $updatedBy
 * @property Files $thumbMain
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%document}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'title', 'type', 'created_at', 'updated_at', 'status'], 'required'],
            [['type', 'created_by', 'created_at', 'updated_by', 'updated_at', 'status', 'thumb_main', 'abs_sort'], 'integer'],
            [['content'], 'string'],
            [['name', 'title', 'reprint_from'], 'string', 'max' => 200],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
            [['thumb_main'], 'exist', 'skipOnError' => true, 'targetClass' => Files::className(), 'targetAttribute' => ['thumb_main' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', '名称'),
            'title' => Yii::t('app', '标题'),
            'type' => Yii::t('app', '类型'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', '状态'),
            'content' => Yii::t('app', '主体内容'),
            'thumb_main' => Yii::t('app', '主缩略图'),
            'reprint_from' => Yii::t('app', '转载于'),
            'abs_sort' => Yii::t('app', '固定排序'),
        ];
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
    public function getThumbMain()
    {
        return $this->hasOne(Files::className(), ['id' => 'thumb_main']);
    }
}
