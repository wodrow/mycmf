<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-19
 * Time: 下午12:41
 */

namespace common\components\tools;


class NumberHelper
{
    /**
     * @param int $start angka awal
     * @param int $end angka akhir
     * @param boolean $pad apakah nilai array menggunakan str_pad
     * @param int $pad_length panjang str_pad
     * @param string $pad_string string untuk str_pad
     * @param boolean $key_pad apakah key array menggunakan str_pad
     * @return array
     */
    public function numberRepeatAsArray($start, $end, $pad = false, $pad_length = 1, $pad_string = "0", $key_pad = false) {
        $result = [];

        for($i=$start; $i<=$end; $i++) {
            $value = $pad ? str_pad($i, $pad_length, $pad_string, STR_PAD_LEFT) : $i;
            $key = $key_pad ? $value : $i;
            $result[$key] = $value;
        }

        return $result;
    }
}