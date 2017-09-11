<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/11/17
 * Time: 11:10 AM
 */

namespace common\components\validators;


use yii\validators\Validator;

class ArrayValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (!is_array($model->$attribute)){
            $this->addError($model, $attribute, $attribute . '必须是一个数组');
        }
    }
}