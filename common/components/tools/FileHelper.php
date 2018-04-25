<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-19
 * Time: 上午11:11
 */

namespace common\components\tools;



use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use League\Flysystem\MountManager;
use League\Flysystem\Sftp\SftpAdapter;

class FileHelper extends \yii\helpers\FileHelper
{
    /**
     * 获取文件后缀名
     * @param $file
     * @return mixed
     */
    public static function getExtensionName1($file)
    {
        return pathinfo($file, PATHINFO_EXTENSION);
    }

    /**
     * Baca isi sebuah file
     *
     * @param string $filename
     * @return string
     */
    public static function readFile($filename) {
        $fo = fopen($filename, 'r');
        $scr = fread($fo, filesize($filename));
        fclose($fo);
        return $scr;
    }

    public static function renderSourceCode($filename, $lang = 'php') {
        echo Html::beginTag('pre', [
            'class' => 'line-numbers'
        ]);
        echo Html::beginTag('code', [
            'class' => 'language-'.$lang
        ]);
        echo htmlentities(FileHelper::readFile($filename));
        echo Html::endTag('code');
        echo Html::endTag('pre');
    }

    /**
     * Menghapus seluruh file dalam sebuah directory
     *
     * @param string $dir
     */
    public static function deleteFiles($dir) {
        if (is_dir($dir)) {
            array_map('unlink', glob($dir."*"));
        }
    }

    /**
     * require League\Flysystem and see your config for use
     * @return MountManager
     */
    public static function getMountManager()
    {
        $adapter = new Local(\Yii::$app->fs_local->path);
        $fs_local = new Filesystem($adapter);
        $adapter = new SftpAdapter([
            'host' => \Yii::$app->sftp_local->host,
            'port' => \Yii::$app->sftp_local->port,
            'username' => \Yii::$app->sftp_local->username,
            'password' => \Yii::$app->sftp_local->password,
            'root' => \Yii::$app->sftp_local->root,
        ]);
        $sftp_local = new Filesystem($adapter);
        $manager = new MountManager();
        $manager->mountFilesystem('fs_local', $fs_local);
        $manager->mountFilesystem('sftp_local', $sftp_local);
        return $manager;
    }

    public static function downloadSourceDirToTarget($source, $s_path, $target, $t_path)
    {
        $manager = self::getMountManager();
        $contents = $manager->listContents("{$source}://{$s_path}", true);
        foreach ($contents as $k => $v) {
            $_type = $v['type'];
            $_path = str_replace($s_path, '', $v['path']);
            $_sftp_path = "{$target}://{$t_path}".$_path;
            $_fs_path = "{$source}://".$v['path'];
            $update = false;
            if ($_type!='dir'){
                if (!$manager->has($_sftp_path)) {
                    $update = true;
                } elseif ($manager->getTimestamp($_fs_path) > $manager->getTimestamp($_sftp_path)) {
                    $update = true;
                }
                if ($update) {
                    $manager->put($_sftp_path, $manager->read($_fs_path));
                }
            }else{
                if (!$manager->has($_sftp_path)){
                    $manager->createDir($_sftp_path);
                }
            }
        }
    }
}