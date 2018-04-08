<?php

namespace common\models\db\base;

use Yii;

/**
 * This is the model class for table "{{%shop}}".
 *
 * @property int $id
 * @property string $name
 * @property int $created_at
 * @property string $created_by
 * @property int $updated_at
 * @property string $updated_by
 * @property string $owner_by
 * @property int $status
 */
class Shop extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%shop}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'created_at', 'created_by', 'updated_at', 'updated_by', 'owner_by', 'status'], 'required'],
            [['created_at', 'updated_at', 'status'], 'default', 'value' => null],
            [['created_at', 'updated_at', 'status'], 'integer'],
            [['created_by', 'updated_by', 'owner_by'], 'number'],
            [['name'], 'string', 'max' => 200],
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
            'created_at' => Yii::t('app', 'Created At'),
            'created_by' => Yii::t('app', 'Created By'),
            'updated_at' => Yii::t('app', 'Updated At'),
            'updated_by' => Yii::t('app', 'Updated By'),
            'owner_by' => Yii::t('app', 'Owner By'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
