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
    const NAME = 'sm.ms';

    public function uploadLocalFile($file)
    {
        $url = 'https://sm.ms/api/upload';
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
            throw new ErrorException(self::NAME."上传失败");
        }
        return $r['data'];
    }
}