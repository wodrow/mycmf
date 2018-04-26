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
    public $waters;

    public function attributeLabels()
    {
        return [
            'url' => '帖子URL',
            'waters' => '水贴关键字',
        ];
    }

    public function rules()
    {
        return [
            ['url', 'required'],
            ['url', 'url'],
            ['url', 'checkIsTieZi'],

            ['waters', 'safe'],
        ];
    }

    public function checkIsTieZi($attribute, $params)
    {
        if (!$this->getErrors()) {
            $str = "://tieba.baidu.com/p/";
            if (strpos($this->$attribute, $str)!==false) {
            } else {
                $this->addError($attribute, '不是帖子');
            }
        }
    }
}