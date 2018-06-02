<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-6-2
 * Time: 下午5:26
 */

namespace frontend\modules\videos\models;


use yii\base\Model;

class FormVideoUpload extends Model
{
    public $video_files;
    public $code;

    public function attributeLabels()
    {
        return [
            'video_files' => "需要上传的视频文件,不超过20条",
            'code' => "验证码",
        ];
    }

    public function rules()
    {
        return [
            ['video_files', 'required'],
//            ['video_files', 'file'],
            ['code', 'trim'],
            ['code', 'required'],
            ['code', 'captcha'],
        ];
    }
}