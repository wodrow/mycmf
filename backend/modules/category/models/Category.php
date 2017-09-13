<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/13/17
 * Time: 9:12 AM
 */

namespace backend\modules\category\models;


class Category extends \common\models\db\Category
{
    public function rules()
    {
        return [
            [['pid', 'status', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['title', 'status'], 'required'],
            [['title'], 'string', 'max' => 50]
        ];
    }
}