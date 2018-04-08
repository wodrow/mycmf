<?php

namespace common\models\db\base;

use Yii;

/**
 * This is the model class for table "{{%document}}".
 *
 * @property int $id
 * @property string $name
 * @property string $title
 * @property int $type
 * @property string $created_by
 * @property int $created_at
 * @property string $updated_by
 * @property int $updated_at
 * @property int $status
 * @property string $content
 * @property string $reprint_from
 * @property int $abs_sort
 *
 * @property User $createdBy
 * @property User $updatedBy
 */
class Document extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%document}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'title', 'type', 'created_at', 'updated_at', 'status'], 'required'],
            [['type', 'created_at', 'updated_at', 'status', 'abs_sort'], 'default', 'value' => null],
            [['type', 'created_at', 'updated_at', 'status', 'abs_sort'], 'integer'],
            [['created_by', 'updated_by'], 'number'],
            [['content'], 'string'],
            [['name', 'title', 'reprint_from'], 'string', 'max' => 200],
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
            'title' => Yii::t('app', 'Title'),
            'type' => Yii::t('app', 'Type'),
            'created_by' => Yii::t('app', 'Created By'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'status' => Yii::t('app', 'Status'),
            'content' => Yii::t('app', 'Content'),
            'reprint_from' => Yii::t('app', 'Reprint From'),
            'abs_sort' => Yii::t('app', 'Abs Sort'),
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
}
