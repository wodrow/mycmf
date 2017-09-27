<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 2017/9/25
 * Time: 下午 2:05
 */

namespace frontend\modules\test;


use yii\base\Module;

class TestModule extends Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\test\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}