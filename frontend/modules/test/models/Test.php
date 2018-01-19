<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-19
 * Time: 上午10:18
 */

namespace frontend\modules\test\models;


use yii\helpers\ArrayHelper;

class Test extends \common\models\db\Test
{
    public $file;

    public function rules()
    {
        $p_rule = parent::rules();
        $rule = [
            ['file', 'safe'],
        ];
        $rule = ArrayHelper::merge($p_rule, $rule);
        return $rule;
    }
}