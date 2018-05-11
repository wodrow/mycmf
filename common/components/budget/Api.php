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
     * @return ApiResp
     */
    public function uploadLocalFile($file);

    /**
     * @param string $url
     * @return ApiResp
     */
    public function uploadFormUrl($url);
}