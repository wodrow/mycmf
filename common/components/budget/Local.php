<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-6-2
 * Time: 下午2:00
 */

namespace common\components\budget;


class Local extends Bed
{
    const NAME = 'local';

    public function uploadFormUrl($url)
    {
        // TODO: Implement uploadFormUrl() method.
    }

    public function uploadLocalFile($file)
    {
        $fname = basename($file);
        $path = "@storage_root/uploads/{$fname}";
        $url = "@storage_url/uploads/{$fname}";
        $upload_file = \Yii::getAlias("{$path}");
        $upload_url = \Yii::getAlias("{$url}");
        rename($file, $upload_file);
        $api_resp = new ApiResp();
        $api_resp->url = $upload_url;
        $api_resp->path = $api_resp->delete_url = $path;
        $api_resp->filename = $api_resp->storename = $fname;
        $api_resp->uploaded_at = time();
        $api_resp->uploaded_ip = '127.0.0.1';
        return $api_resp;
    }

    public function deleteByUrl($delete_url)
    {
        // TODO: Implement deleteByUrl() method.
    }
}