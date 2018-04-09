<?php

namespace common\models\db;

/**
 * This is the model class for table "mycmf_log".
 */
class Log extends \common\models\db\base\Log
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['level'], 'integer'],
            [['log_time'], 'number'],
            [['prefix', 'message'], 'string'],
            [['category'], 'string', 'max' => 255]
        ]);
    }
}
