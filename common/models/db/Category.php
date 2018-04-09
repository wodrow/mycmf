<?php

namespace common\models\db;

/**
 * This is the model class for table "mycmf_categroy".
 */
class Category extends \common\models\db\base\Category
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return array_replace_recursive(parent::rules(),
	    [
            [['pid', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'required'],
            [['title'], 'string', 'max' => 50]
        ]);
    }
	
}
