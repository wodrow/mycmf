<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-16
 * Time: 上午10:57
 */

namespace common\components\budget;


interface Api
{
    /**
     * @param string $file file detail path
     * @return array
     */
    public function uploadLocalFile($file);
}