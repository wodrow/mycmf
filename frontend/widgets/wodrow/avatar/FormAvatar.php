<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-23
 * Time: 下午1:57
 */

namespace frontend\widgets\wodrow\avatar;


use yii\base\Model;

class FormAvatar extends Model
{
    public $avatar;

    public function rules()
    {
        return [
            ['avatar', 'required'],
            ['avatar', 'image'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'avatar' => '头像'
        ];
    }
}