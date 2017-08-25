<?php

namespace common\models\db;

use \common\models\db\base\Tag as BaseTag;

/**
 * This is the model class for table "mycmf_tag".
 *
 * @property \common\models\db\User $createdBy
 * @property \common\models\db\User $updatedBy
 */
class Tag extends BaseTag
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'required'],
            [['status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title'], 'string', 'max' => 20],
            [['title'], 'unique']
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(\common\models\db\User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdatedBy()
    {
        return $this->hasOne(\common\models\db\User::className(), ['id' => 'updated_by']);
    }
}
