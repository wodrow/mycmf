<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-2
 * Time: 下午1:58
 */

namespace frontend\modules\utils\models;


use yii\base\Model;

class DoubleTextForm extends Model
{
    public $form_up;
    public $form_dowm;

    public function rules()
    {
        return [
            [['form_up', 'form_dowm'], 'safe'],
        ];
    }
}