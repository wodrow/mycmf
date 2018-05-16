<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-15
 * Time: 下午4:57
 */

namespace common\rewrite\creocoder\flysystem;


use Aws\S3\S3Client;
use League\Flysystem\AwsS3v3\AwsS3Adapter;

class AwsS3Filesystem extends \creocoder\flysystem\AwsS3Filesystem
{
    /**
     * @return AwsS3Adapter
     */
    protected function prepareAdapter()
    {
        $config = ['key' => $this->key, 'secret' => $this->secret];

        if ($this->region !== null) {
            $config['region'] = $this->region;
        }

        if ($this->baseUrl !== null) {
            $config['base_url'] = $this->baseUrl;
        }

        return new AwsS3Adapter(
            S3Client::factory($config),
            $this->bucket,
            $this->prefix,
            $this->options
        );
    }
}