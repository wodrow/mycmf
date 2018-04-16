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
 * @property string $uploaded_ip
 * @property int $size
 * @property int $width
 * @property int $height
 * @property string $path
 * @property string $budget_id
 * @property int $status
 * @property string $detail_data
 *
 * @property Budget $budget
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
            [['type', 'url', 'delete_url', 'filename', 'created_at'], 'required'],
            [['type', 'created_at', 'size', 'width', 'height', 'budget_id', 'status'], 'integer'],
            [['detail_data'], 'string'],
            [['url', 'delete_url', 'filename', 'path'], 'string', 'max' => 200],
            [['uploaded_ip'], 'string', 'max' => 30],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => Budget::className(), 'targetAttribute' => ['budget_id' => 'id']],
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
            'uploaded_ip' => Yii::t('app', 'Uploaded Ip'),
            'size' => Yii::t('app', 'Size'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'path' => Yii::t('app', 'Path'),
            'budget_id' => Yii::t('app', 'Budget ID'),
            'status' => Yii::t('app', 'Status'),
            'detail_data' => Yii::t('app', 'Detail Data'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBudget()
    {
        return $this->hasOne(Budget::className(), ['id' => 'budget_id']);
    }
}
