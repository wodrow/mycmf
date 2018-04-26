<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-12-27
 * Time: 上午9:34
 */

namespace common\components\tools;


class Random
{
    /**
     * 生成随机二维数组
     * @param $l 长度
     * @return array
     */
    public static function get_rand_arr($l){
        $x = [];
        for($i=0;$i<$l;$i++){
            $x[$i]['rand'] = rand(1000,9999);
        }
        return $x;
    }
}