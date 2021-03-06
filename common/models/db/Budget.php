<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-16
 * Time: 上午10:51
 */

namespace common\models\db;

use common\components\budget\Api;
use common\components\budget\Local;
use common\components\budget\Nos;
use common\components\budget\Smms;
use yii\base\ErrorException;

/**
 * Class Budget
 * @package common\models\db
 *
 * @property Api $operator
 */
class Budget extends \common\models\db\base\Budget
{
    public function getOperator()
    {
        switch ($this->name) {
            case Local::NAME;
                $operator = new Local();
                break;
            case Smms::NAME;
                $operator = new Smms();
                break;
            case Nos::NAME;
                $operator = new Nos();
                break;
            default:
                throw new ErrorException("没有找到图床！");
                break;
        }
        return $operator;
    }
}