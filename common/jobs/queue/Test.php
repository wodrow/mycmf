<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-6-5
 * Time: 下午3:53
 */

namespace common\jobs\queue;


use common\components\tools\Tools;
use yii\base\Component;
use yii\queue\JobInterface;

/**
 * Class Test
 * @package common\jobs\queue
 *
 * $id = Yii::$app->queue->delay(5)->push(new \common\jobs\queue\Test([
'xxx' => "string",
]));
 */
class Test extends Component implements JobInterface
{
    public $xxx;

    public function execute($queue)
    {
        Tools::log($this->xxx);
    }
}