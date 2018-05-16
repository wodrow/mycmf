<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-16
 * Time: 上午9:13
 */

namespace common\components\wodrow\filesystem;


use Aws\Exception\AwsException;
use Aws\S3\S3Client;
use yii\base\Component;
use yii\base\Exception;

/**
 * Class Nos 网易云对象存储
 * need league/flysystem-aws-s3-v3
 * @package common\components\wodrow\filesystem
 *
 * @property S3Client $s3Client
 */
class Nos extends Component
{
    public $version = 'latest';
    public $region;
    public $key;
    public $secret;
    public $endpoint;
    public $bucketName;
    public $domain;

    /**
     * @var S3Client
     */
    private $_s3Client;

    /**
     * @return S3Client
     */
    public function getS3Client()
    {
        return $this->_s3Client;
    }

    public function setS3Client()
    {
        $this->_s3Client = new S3Client([
            'version'     => $this->version,
            'region'      => $this->region,
            'credentials' => [
                'key'    => $this->key,
                'secret' => $this->secret,
            ],
            'endpoint'      => $this->endpoint,
        ]);
    }

    /**
     * 创建一个桶
     * acl 指的是bucket的访问控制权限，有两种，私有读写，公共读私有写。
     * 私有读写就是只有bucket的拥有者或授权用户才有权限操作
     * 公共读私有写，任意用户可以读，只有授权用户才能写
     *
     * @param string    $bucketName 要创建的bucket名字
     * @param string    $Acl,有效的值为private-->write,public-read-->read
     * @return
     */
    public function createBucket($bucketName, $Acl){
        try {
            $result = $this->s3Client->createBucket([
                'Bucket' => $bucketName,
                'ACL' => $Acl
            ]);
            return $result;
        }catch (AwsException $e) {
            throw $e;
        }
    }

    /**
     * 判断桶是否存在
     * @param string $bucketName 桶名
     * @return bool
     */
    function doesBucketExist($bucketName){
        try{
            $res = $this->s3Client->doesBucketExist($bucketName);
            return $res;
        } catch (\Aws\Exception\AwsException $e){
            throw $e;
        }
    }

    /**
     * 获取用户所有的桶
     */
    public function listBuckets()
    {
        $buckets = $this->s3Client->listBuckets();
        return $buckets['Buckets'];
    }

    /**
     * 根据给定的桶名删除桶
     * @param string $bucketName 桶名
     */
    public function deleteBucket($bucketName){
        try {
            $deleteResult = $this->s3Client->deleteBucket(['Bucket' => $bucketName]);
            return $deleteResult;
        } catch (Exception $exception){
            throw $exception;
        }
    }

    /**
     * 设置桶的Acl
     * @param string $bucketName 桶名
     * @param string $Acl 有效的值为private,public-read
     */
    public function putBucketAcl($bucketName, $Acl){
        try{
            $this->s3Client->putBucketAcl(array(
                'ACL' => $Acl,
                'Bucket' => $bucketName,));
        } catch (\Aws\Exception\AwsException $exception){
            throw $exception;
        }
    }

    /**
     * 获取桶的Acl
     * @param string $bucketName 桶名
     */
    public function getBucketAcl($bucketName){
        try{
            $result = $this->s3Client->getBucketAcl(['Bucket'=>$bucketName]);
            return $result;
        } catch (\Aws\Exception\AwsException $e){
            throw $e;
        }
    }

    /**
     * 字符串上传 [上传的字符串内容不超过100M]
     * @param string $objectName 对象名
     * @param $Body 'mixed type: string|resource|\Guzzle\Http\EntityBodyInterface'
     */
    function putObject($objectName, $Body){
        try{
            $result = $this->s3Client->putObject(['Bucket'=>$this->bucketName,
                'Key'=>$objectName,
                'Body'=>$Body]);
            return $result;
        } catch (\Aws\Exception\AwsException $exception){
            throw $exception;
        }
    }

    /**
     * 本地文件上传 [上传的字符串内容不超过100M]
     * @param string $objectName 对象名
     * @param string $filePath
     */
    function putObjectByFilePath($objectName,$filePath){
        return $this->putObject($objectName, fopen($filePath, 'r+'));
    }

    /**
     * 分片上传本地文件二进制
     * @param string $objectName 对象名
     * @param $body 'mixed type: string|resource|\Guzzle\Http\EntityBodyInterface'
     */
    function uploadObject($objectName, $body){
        try{
            $result = $this->s3Client->upload($this->bucketName, $objectName, $body,'public-read');
            return $result;
        } catch (\Aws\Exception\AwsException $exception){
            throw $exception;
        }
    }

    /**
     * 分片上传本地文件二进制
     * @param string $objectName 对象名
     * @param string $filePath
     */
    function uploadObjectByFilePath($objectName, $filePath){
        return $this->uploadObject($objectName, fopen($filePath, 'r+'));
    }

    /**
     * 获取对象
     * @param string $objectName 对象名
     */
    public function getObject($objectName){
        try{
            $result = $this->s3Client->getObject(['Bucket'=>$this->bucketName,
                'Key'=>$objectName]);
            // The 'Body' value of the result is an EntityBody object
//            echo get_class($result['Body']) . "\n";
            // > Guzzle\Http\EntityBody
            // The 'Body' value can be cast to a string
//            echo $result['Body'] . "\n";
            // > Hello!
            return $result;
        } catch (\Aws\Exception\AwsException $e){
            throw $e;
        }
    }

    /**
     * 下载文件到本地文件
     * @param string $objectName 对象名
     * @param string $fileName   存储的文件名
     */

    public function getObjectToLocalFile($objectName, $fileName){
        try{
            $result = $this->s3Client->getObject(['Bucket'=>$this->bucketName,
                'Key'=>$objectName,
                'SaveAs'=>$fileName]);
            return $result;
        } catch (\Aws\Exception\AwsException $e){
            throw $e;
        }
    }

    /**
     * 范围下载 [如果存储在S3中的文件较大，并且您只需要其中的一部分内容，您可以使用范围下载，下载指定范围的数据，如果指定的下载范围为"0-100"，则返回结果为第0字节到第100字节的数据，返回的数据包含第100字节，即[0,100]，如果指定的范围无效则下载整个文件，以下源代码获取[0,100]字节的内容]
     * @param string $objectName 对象名
     * @param string $fileName   存储的文件名
     * @param $range
     */
    public function getObjectOfRange($objectName, $fileName, $range){
        try{
            $result = $this->s3Client->getObject(['Bucket'=>$this->bucketName,
                'Key'=>$objectName,
                'Range'=>$range,
                'SaveAs' => $fileName,
            ]);
            return $result;
        } catch (\Aws\Exception\AwsException $e){
            throw $e;
        }
    }

    /**
     * 判断文件是否存在
     * @param string $objectName 对象名
     * @return bool
     */
    function doesObjectExist($objectName)
    {
        try{
            $exist = $this->s3Client->doesObjectExist($this->bucketName, $objectName);
        } catch(\Aws\Exception\AwsException $e) {
            throw $e;
        }
        return $exist;
    }

    /**
     * 删除单个文件
     * @param string $objectName 对象名
     */
    function deleteObject($objectName)
    {
        try{
            $this->s3Client->deleteObject(['Bucket'=>$this->bucketName, 'Key'=>$objectName]);
        } catch(AwsException $e) {
            throw $e;
        }
    }

    /**
     * 删除多个文件 [该接口目前不兼容，暂时不可用]
     * 批量删除object
     * @param array $objects
     * @return null
     */
    function deleteObjects($objects)
    {
        try{
            $this->s3Client->deleteObjects($this->bucket, $objects);
        } catch(AwsException $e) {
            throw $e;
        }
    }

    /**
     * 拷贝文件 [支持跨桶的文件copy]
     * @param $srcBucketName
     * @param $srcObjectName
     * @param $destBucketName
     * @param $destObjectName
     */
    function copyObject($srcBucketName, $srcObjectName, $destBucketName, $destObjectName){
        try{
            $this->s3Client->copyObject(['Bucket'=>$destBucketName,'Key'=>$destObjectName,
                'CopySource'=>'/' . $srcBucketName . '/' . $srcObjectName]);
        } catch (\Aws\Exception\AwsException $exception){
            throw $exception;
        }
    }

    /**
     * 获取文件的文件元信息
     * @param string $objectName 对象名
     */
    function getObjectMeta($objectName){
        try{
            $result = $this->s3Client->headObject(['Bucket'=>$this->bucketName, 'Key'=>$objectName]);
            return $result;
        } catch (\Aws\Exception\AwsException $exception){
            throw $exception;
        }
    }

    public function init()
    {
        parent::init(); // TODO: Change the autogenerated stub
        $this->setS3Client();
    }
}