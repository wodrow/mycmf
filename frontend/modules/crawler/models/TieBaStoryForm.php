<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-7
 * Time: 下午10:25
 */

namespace frontend\modules\crawler\models;


use yii\base\Model;

class TieBaStoryForm extends Model
{
    public $url;

    public function attributeLabels()
    {
        return [
            'url' => 'URL',
        ];
    }

    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'url'],
        ];
    }
}