<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-16
 * Time: 上午10:57
 */

namespace common\components\budget;


use yii\base\ErrorException;

interface Api
{
    /**
     * @param string $file file detail path
     * @throws ErrorException
     * @return ApiResp
     */
    public function uploadLocalFile($file);

    /**
     * @param string $url
     * @throws ErrorException
     * @return ApiResp
     */
    public function uploadFormUrl($url);

    /**
     * @param $delete_url
     * @throws ErrorException
     */
    public function deleteByUrl($delete_url);
}