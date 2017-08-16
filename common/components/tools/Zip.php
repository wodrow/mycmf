<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 8/16/17
 * Time: 10:22 AM
 */

namespace common\components\tools;

class Zip
{
    /**
     * @param string $filename dirpath&name
     */
    public static function createFile($filename)
    {
        if (!file_exists($filename)){
            $fopen = fopen($filename,   'wb ');//新建文件命令
            fclose($fopen);
        }
    }

    /**
     * 压缩多级目录
     * $openFile:目录句柄
     * @param \ZipArchive $zipObj:Zip对象
     * $sourceAbso:源文件夹路径
     */
    public static function createZip($openFile,$zipObj,$sourceAbso,$newRelat = '')
    {
        while(($file = readdir($openFile)) != false)
        {
            if($file=="." || $file=="..")
                continue;

            /*源目录路径(绝对路径)*/
            $sourceTemp = $sourceAbso.'/'.$file;
            /*目标目录路径(相对路径)*/
            $newTemp = $newRelat==''?$file:$newRelat.'/'.$file;
            if(is_dir($sourceTemp))
            {
                //echo '创建'.$newTemp.'文件夹<br/>';
                $zipObj->addEmptyDir($newTemp);/*这里注意：php只需传递一个文件夹名称路径即可*/
                self::createZip(opendir($sourceTemp),$zipObj,$sourceTemp,$newTemp);
            }
            if(is_file($sourceTemp))
            {
                //echo '创建'.$newTemp.'文件<br/>';
                $zipObj->addFile($sourceTemp,$newTemp);
            }
        }
    }

    public static function makeDirToZip($dir, $filename)
    {
        if (!file_exists($filename)){
            self::createFile($filename);
        }
        $zip=new \ZipArchive();
        //参数1:zip保存路径，参数2：ZIPARCHIVE::CREATE没有即是创建
        if(!$zip->open($filename,\ZipArchive::CREATE))
        {
            throw new \Exception("创建zip失败<br/>", 1077);
        }
        self::createZip(opendir($dir),$zip,$dir);
        $zip->close();
    }

    /**
     * @param $filename 文件名（含路径）
     */
    public static function download($filename)
    {
        if(!file_exists($filename)){
            exit("无法找到文件"); //即使创建，仍有可能失败。。。。
        }
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
        header('Content-disposition: attachment; filename='.basename($filename)); //文件名
        header("Content-Type: application/zip"); //zip格式的
        header("Content-Transfer-Encoding: binary"); //告诉浏览器，这是二进制文件
        header('Content-Length: '. filesize($filename)); //告诉浏览器，文件大小
        @readfile($filename);
    }
}