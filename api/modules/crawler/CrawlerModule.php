<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-6
 * Time: 下午5:41
 */

namespace api\modules\crawler;


use kartik\base\Module;

class CrawlerModule extends Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'api\modules\crawler\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();

        // custom initialization code goes here
    }
}