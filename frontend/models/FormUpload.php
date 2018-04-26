<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-12
 * Time: 下午4:53
 */

namespace frontend\models;


use yii\base\Model;

class FormUpload extends Model
{
    public $file;

    public function rules()
    {
        return [
            ['file', 'required'],
            ['file', 'file'],
        ];
    }
}