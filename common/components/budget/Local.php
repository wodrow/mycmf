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
        $upload_file = \Yii::getAlias('@storage_root/uploads/').basename($file);
        $upload_url = \Yii::getAlias('@storage_url/uploads/').basename($file);
        rename($file, $upload_file);
        $api_resp = new ApiResp();
        $api_resp->url = $upload_url;
        $api_resp->path = $api_resp->delete_url = $upload_file;
        $api_resp->filename = $api_resp->storename = basename($file);
        $api_resp->uploaded_at = time();
        $api_resp->uploaded_ip = '127.0.0.1';
        return $api_resp;
    }

    public function deleteByUrl($delete_url)
    {
        // TODO: Implement deleteByUrl() method.
    }
}