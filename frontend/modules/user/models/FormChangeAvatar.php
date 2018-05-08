<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-8
 * Time: 下午5:29
 */

namespace frontend\modules\user\models;


use yii\base\Model;

class FormChangeAvatar extends Model
{
    public $avatar;

    public function attributeLabels()
    {
        return [
            'avatar' => "头像",
        ];
    }

    public function rules()
    {
        return [
            ['avatar', 'required'],
            ['avatar', 'string', 'max' => 200],
        ];
    }
}