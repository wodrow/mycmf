<?php

namespace common\models\db\base;

use Yii;

/**
 * This is the model class for table "{{%invite_code}}".
 *
 * @property string $id
 * @property string $code
 * @property int $created_at
 * @property int $used_at
 * @property int $status
 */
class InviteCode extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%invite_code}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['code', 'created_at', 'used_at', 'status'], 'required'],
            [['created_at', 'used_at', 'status'], 'integer'],
            [['code'], 'string', 'max' => 50],
            [['code'], 'unique'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'code' => Yii::t('app', 'Code'),
            'created_at' => Yii::t('app', 'Created At'),
            'used_at' => Yii::t('app', 'Used At'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
