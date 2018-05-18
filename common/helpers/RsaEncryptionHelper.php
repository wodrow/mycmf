<?php
namespace common\helpers;

/**
 * RSA 加密算法
 *
 * Class RsaEncryptionHelper
 * @package common\helpers
 */
class RsaEncryptionHelper
{
    /**
     * 加密
     * openssl genrsa -out rsa_private_key.pem 1024 // 生成原始 RSA私钥文件 rsa_private_key.pem
     * openssl pkcs8 -topk8 -inform PEM -in rsa_private_key.pem -outform PEM -nocrypt -out private_key.pem // 将原始 RSA私钥转换为 pkcs8格式
     * openssl rsa -in rsa_private_key.pem -pubout -out rsa_public_key.pem // 生成RSA公钥 rsa_public_key.pem
     *
     * @param string $data 数据
     * @param string $rsaPrivateKey 私钥PEM文件的绝对路径
     * @return string
     */
    public static function enCode($data, $rsaPrivateKey)
    {
        /* 获取私钥PEM文件内容 */
        $priKey = file_get_contents($rsaPrivateKey);

        /* 从PEM文件中提取私钥 */
        $res = openssl_get_privatekey($priKey);

        /* 对数据进行签名 */
        //openssl_sign($data, $sign, $res);
        openssl_private_encrypt($data, $sign, $res);

        /* 释放资源 */
        openssl_free_key($res);

        /* 对签名进行Base64编码，变为可读的字符串 */
        $sign = base64_encode($sign);

        return $sign;
    }

    /**
     * 解密
     *
     * @param string $data 加密后的数据
     * @param string $rsaPublicKey 公钥PEM文件的绝对路径
     * @return mixed
     */
    public static function deCode($data, $rsaPublicKey)
    {
        /* 获取公钥PEM文件内容 */
        $pubKey = file_get_contents($rsaPublicKey);

        /* 从PEM文件中提取公钥 */
        $res = openssl_get_publickey($pubKey);

        /* 对数据进行解密 */
        openssl_public_decrypt(base64_decode($data), $decrypted, $res);

        /* 释放资源 */
        openssl_free_key($res);

        return $decrypted;
    }

    /**
     * RSA签名
     * @param $data 待签名数据(按照文档说明拼成的字符串)
     * $private_key_path 商户私钥文件路径
     * return 签名结果
     */
    public static function rsaSign($data, $priKey) {
//        $priKey = file_get_contents($private_key_path);
        $res = openssl_get_privatekey($priKey);
        openssl_sign($data, $sign, $res);
        openssl_free_key($res);
        //base64编码
        $sign = base64_encode($sign);
        return $sign;
    }

    /**
     * RSA验签
     * @param $data 待签名数据(如果是xml返回则数据为<plain>标签的值,包含<plain>标签，如果为form(key-value，一般指异步返回类的)返回,则需要按照文档中进行key的顺序进行，value拼接)
     * $ali_public_key_path 富友的公钥文件路径
     * @param $sign 要校对的的签名结果
     * return 验证结果
     */
    public static function rsaVerify($data, $pubKey, $sign)  {

//        $pubKey = file_get_contents($ali_public_key_path);
        $res = openssl_get_publickey($pubKey);
        $result = (bool)openssl_verify($data, base64_decode($sign), $res);
        openssl_free_key($res);
        return $result;
    }
}