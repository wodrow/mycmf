<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-14
 * Time: 上午11:01
 */

namespace common\components\wodrow\datecheck;


use yii\base\Component;
use yii\base\ErrorException;
use yii\httpclient\Client;

class DateCheck extends Component
{
    const WORKDAY = 0;
    const WEEKEND = 1;
    const HOLIDAY = 2;

    public function checkHoliday($date)
    {
        $c_url = 'http://api.goseek.cn/Tools/holiday';
        $client = new Client();
        $r = $client->get($c_url, ['date'=>$date])->send();
        if ($r->statusCode!=200){
            throw new ErrorException("{$c_url} 响应数据有误");
        }
        $b = json_decode($r->content);
        if ($r->code!=10000){
            throw new ErrorException("{$c_url} 获取数据有误");
        }
        return $b->data;
    }
}