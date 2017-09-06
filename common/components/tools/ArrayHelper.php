<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/5/17
 * Time: 8:55 AM
 */

namespace common\components\tools;


class ArrayHelper
{
    /**
     * @param $arr 需要处理的数组
     * @param array $out 输出的结果
     * @param int $deep 键深
     * @param array $k_attr 键说明
     * @param array $v_attr 值说明
     */
    public static function arr_info($arr, &$out = [], &$deep = 0, $k_attr = [], $v_attr = [])
    {
        if (is_array($arr)){
            $deep++;
            foreach($arr as $k => $v){
                $attr1 = null;
                foreach ($k_attr as $k1 => $v1){
                    if ($k1 == $k){
                        $attr1 = $v1;
                    }
                }
                $attr2 = null;
                foreach ($k_attr as $k1 => $v1){
                    if ($k1 == $v){
                        $attr2 = $v1;
                    }
                }
                $out[] = [
                    'k' => $k,
                    'v' => is_array($v)?null:$v,
                    'deep' => $deep,
                    'k_attr' => $attr1,
                    'v_attr' => $attr2,
                ];
                $fun = __FUNCTION__;
                self::$fun($v, $out, $deep, $k_attr, $v_attr);
            }
            $deep--;
        }
    }
}