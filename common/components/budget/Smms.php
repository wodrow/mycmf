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

    public function uploadLocalFile($file)
    {
        $url = self::UPLOAD_URL;
        $body = fopen($file, 'r');
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
        $r = json_decode($r, true, 512);
        if ($r['code']!='success'){
            throw new ErrorException(self::TITLE."上传失败");
        }
        return $r['data'];
    }
}