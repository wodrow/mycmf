<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 8/16/17
 * Time: 11:04 AM
 */

namespace common\components\config;


use common\config\Env;
use yii\base\Component;

/**
 * Class Config
 * @package common\components\config
 * @property Env $env
 */
class Config extends Component
{
    /**
     * @return Env $env
     */
    public function getEnv()
    {
        return new Env();
    }
}