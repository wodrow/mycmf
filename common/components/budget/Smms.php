<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-16
 * Time: 上午10:53
 */

namespace common\components\budget;

use yii\base\ErrorException;

class Smms extends Bed
{
    const NAME = 'smms';
    const TITLE = 'sm.ms';
    const UPLOAD_URL = 'https://sm.ms/api/upload';

    /**
     * @param string $file
     * @return ApiResp data
     */
    public function uploadLocalFile($file)
    {
        $body = fopen($file, 'r');
        $api_resp = $this->_uploadByBody($body);
        return $api_resp;
    }

    public function deleteByUrl($delete_url)
    {
        $client = new \GuzzleHttp\Client();
        $r = $client->request('GET', $delete_url);
        if ($r->getStatusCode()!=200){
            throw new ErrorException(self::TITLE."删除失败");
        }
    }

    /**
     * @param string $url
     * @return ApiResp
     */
    public function uploadFormUrl($url)
    {
        $body = file_get_contents($url);
        $api_resp = $this->_uploadByBody($body);
        return $api_resp;
    }

    /**
     * @param $body
     * @return ApiResp
     * @throws ErrorException
     */
    private function _uploadByBody($body)
    {
        $url = self::UPLOAD_URL;
        $client = new \GuzzleHttp\Client();
        $r = $client->request('POST', $url, [
            'multipart' => [
                [
                    'name'     => 'smfile',
                    'contents' => $body,
                ],
            ],
        ]);
        $r = $r->getBody();
        $r = json_decode($r);
        if ($r->code!='success'){
            throw new ErrorException(self::TITLE."上传失败");
        }
        $data = $r->data;
        $api_resp = new ApiResp();
        $api_resp->width = $data->width;
        $api_resp->height = $data->height;
        $api_resp->filename = $data->filename;
        $api_resp->storename = $data->storename;
        $api_resp->size = $data->size;
        $api_resp->path = $data->path;
        $api_resp->hash = $data->hash;
        $api_resp->uploaded_at = $data->timestamp;
        $api_resp->uploaded_ip = $data->ip;
        $api_resp->url = $data->url;
        $api_resp->delete_url = $data->delete;
        return $api_resp;
    }
}