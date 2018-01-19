<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-19
 * Time: 上午11:11
 */

namespace common\components\tools;



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
}