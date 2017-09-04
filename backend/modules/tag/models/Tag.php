<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 8/25/17
 * Time: 3:03 PM
 */

namespace backend\modules\tag\models;


class Tag extends \common\models\db\Tag
{
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'created_at' => '创建时间',
            'updated_at' => '修改时间',
            'created_by' => '创建者',
            'updated_by' => '修改者',
            'status' => '状态',
        ];
    }
}