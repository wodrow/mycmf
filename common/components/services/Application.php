<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-10
 * Time: 下午3:54
 */

namespace common\components\services;


use common\servers\Test;
use Yii;
use yii\base\InvalidConfigException;

/**
 * Class Application
 * @package common\components\services
 *
 * @property Test $test
 */
class Application
{
    /**
     * 子服务
     *
     * @var
     */
    public $childService;

    /**
     * @var
     */
    protected $_childService;

    public function __construct($config = [])
    {
        Yii::$service = $this;
        $this->childService = $config;
    }

    /**
     * 得到services 里面配置的子服务childService的实例
     *
     * @param $childServiceName
     * @return mixed
     * @throws InvalidConfigException
     */
    public function getChildService($childServiceName)
    {
        if(!$this->_childService[$childServiceName])
        {
            $childService = $this->childService;
            if(isset($childService[$childServiceName]))
            {
                $service = $childService[$childServiceName];
                $this->_childService[$childServiceName] = Yii::createObject($service);
            }
            else
            {
                throw new InvalidConfigException('Child Service ['.$childServiceName.'] is not find in '.get_called_class().', you must config it! ');
            }
        }

        return $this->_childService[$childServiceName];
    }

    /**
     * @param $attr
     * @return mixed
     * @throws InvalidConfigException
     */
    public function __get($attr)
    {
        return $this->getChildService($attr);
    }
}