<?php

namespace common\models\db\base;

use Yii;

/**
 * This is the model class for table "{{%settings}}".
 *
 * @property string $id
 * @property string $type
 * @property string $section
 * @property string $key
 * @property string $value
 * @property int $active
 * @property string $created
 * @property string $modified
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%settings}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type', 'section', 'key'], 'required'],
            [['value'], 'string'],
            [['created', 'modified'], 'safe'],
            [['type', 'section', 'key'], 'string', 'max' => 255],
            [['active'], 'string', 'max' => 1],
            [['section', 'key'], 'unique', 'targetAttribute' => ['section', 'key']],
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
            'section' => Yii::t('app', 'Section'),
            'key' => Yii::t('app', 'Key'),
            'value' => Yii::t('app', 'Value'),
            'active' => Yii::t('app', 'Active'),
            'created' => Yii::t('app', 'Created'),
            'modified' => Yii::t('app', 'Modified'),
        ];
    }
}
