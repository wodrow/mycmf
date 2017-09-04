<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 8/16/17
 * Time: 6:19 PM
 */

namespace common\models\db;


class User extends \common\models\db\tables\User
{
    /**
     * @return array
     */
    public function attributeLabels()
    {
        return [
            'username' => '用户名',
            'email' => '邮箱',
            'created_at' => '创建时间',
            'updated_at' => '更新时间',
            'status' => '状态',
        ];
    }
}