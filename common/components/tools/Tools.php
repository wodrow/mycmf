<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/5/17
 * Time: 10:20 AM
 */

namespace common\components\tools;


class Tools
{
    /**
     * log message
     * @param $msg
     */
    public static function log($msg)
    {
        $log = New \yii\log\FileTarget();
        $log->logFile = \Yii::$app->getRuntimePath().DIRECTORY_SEPARATOR."logs".DIRECTORY_SEPARATOR."app.log";
        $log->messages[] = [$msg];
        $log->export();
    }

    /**
     * 浏览器友好的变量输出
     * @param mixed $var 变量
     * @param boolean $echo 是否输出 默认为True 如果为false 则返回输出字符串
     * @param string $label 标签 默认为空
     * @param boolean $strict 是否严谨 默认为true
     * @return void|string
     */
    public static function dump($var, $echo=true, $label=null, $strict=true) {
        $label = ($label === null) ? '' : rtrim($label) . ' ';
        if (!$strict) {
            if (ini_get('html_errors')) {
                $output = print_r($var, true);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            } else {
                $output = $label . print_r($var, true);
            }
        } else {
            ob_start();
            var_dump($var);
            $output = ob_get_clean();
            if (!extension_loaded('xdebug')) {
                $output = preg_replace('/\]\=\>\n(\s+)/m', '] => ', $output);
                $output = '<pre>' . $label . htmlspecialchars($output, ENT_QUOTES) . '</pre>';
            }
        }
        if ($echo) {
            echo($output);
            return null;
        }else
            return $output;
    }

    /**
     * 字符串中是数组格式化为数组
     * @param $data
     * @return array
     */
    public static function formatArrStrToArr($data)
    {
        eval("\$data = ".$data.'; ');
        return $data;
    }

    /**
     * 格式化字节大小
     * @param  number $size      字节数
     * @param  string $delimiter 数字和单位分隔符
     * @return string            格式化后的带单位的大小
     * @author 麦当苗儿 <zuojiazi@vip.qq.com>
     */
    public static function format_bytes($size, $delimiter = '') {
        $units = array('B', 'KB', 'MB', 'GB', 'TB', 'PB');
        for ($i = 0; $size >= 1024 && $i < 5; $i++) $size /= 1024;
        return round($size, 2) . $delimiter . $units[$i];
    }

    /**
     * 生成目录
     * @access public
     * @param string $path 目录位置与名称
     * @return void
     * @author wodrow <wodrow451611cv@gmail.com | 1173957281@qq.com>
     */
    public static function createDir($path)
    {
        return is_dir($path) or (self::createDir(dirname($path)) and mkdir($path, 0777));
    }

    /**
     * 获取当前页面完整URL地址
     */
    public static function get_url() {
        $sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
        $php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
        $path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
        $relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
        return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
    }

    /**
     * 根据时间戳返回星期几
     * @param string $time 时间戳
     * @return 星期几
     */
    public static function weekday($time)
    {
        if(is_numeric($time))
        {
            $weekday = array('星期日','星期一','星期二','星期三','星期四','星期五','星期六');
            return $weekday[date('w', $time)];
        }
        return false;
    }

    // 获取文件夹大小
    public static function getDirSize($dir)
    {
        $handle = opendir($dir);
        $sizeResult = 0;
        while (false!==($FolderOrFile = readdir($handle)))
        {
            if($FolderOrFile != "." && $FolderOrFile != "..")
            {
                if(is_dir("$dir/$FolderOrFile"))
                {
                    $sizeResult += self::getDirSize("$dir/$FolderOrFile");
                }
                else
                {
                    $sizeResult += filesize("$dir/$FolderOrFile");
                }
            }
        }
        closedir($handle);
        return $sizeResult;
    }

    // 单位自动转换函数
    public static function getRealSize($size)
    {
        $kb = 1024;         // Kilobyte
        $mb = 1024 * $kb;   // Megabyte
        $gb = 1024 * $mb;   // Gigabyte
        $tb = 1024 * $gb;   // Terabyte
        if($size < $kb)
        {
            return $size." B";
        }
        else if($size < $mb)
        {
            return round($size/$kb,2)." KB";
        }
        else if($size < $gb)
        {
            return round($size/$mb,2)." MB";
        }
        else if($size < $tb)
        {
            return round($size/$gb,2)." GB";
        }
        else
        {
            return round($size/$tb,2)." TB";
        }
    }

    /**
     * @path 路径，支持相对和绝对
     * @absolute 返回的文件数组，是否包含完整路径
     */
    public static function get_files($path, $absolute=1)
    {
        $files = array();
        $_path = realpath($path);
        if (!file_exists($_path)) return false;
        if (is_dir($_path)) {
            $list = scandir($_path);
            foreach ($list as $v) {
                if ($v == '.' || $v == '..') continue;
                $_paths = $_path.'/'.$v;
                if (is_dir($_paths)) {
                    //递归
                    $files = array_merge($files, self::get_files($_paths,$absolute));
                } else {
                    $files[] = $absolute>0 ? $_paths : $v;
                }
            }
        } else {
            if (!is_file($_path)) return false;
            $files[] = $_path;
        }
        return $files;
    }

    /**
     * 删除目录及目录下所有文件或删除指定文件
     * @param str $path   待删除目录路径
     * @param int $delDir 是否删除目录，1或true删除目录，0或false则只删除文件保留目录（包含子目录）
     * @return bool 返回删除状态
     */
    public static function delDirAndFile($path, $delDir = FALSE) {
        if (is_array($path)) {
            foreach ($path as $subPath)
                self::delDirAndFile($subPath, $delDir);
        }
        if (is_dir($path)) {
            $handle = opendir($path);
            if ($handle) {
                while (false !== ( $item = readdir($handle) )) {
                    if ($item != "." && $item != "..")
                        is_dir("$path/$item") ? self::delDirAndFile("$path/$item", $delDir) : unlink("$path/$item");
                }
                closedir($handle);
                if ($delDir)
                    return rmdir($path);
            }
        } else {
            if (file_exists($path)) {
                return unlink($path);
            } else {
                return FALSE;
            }
        }
        clearstatcache();
    }

    /**
     * 将excel转换为数组 by aibhsc
     * 需要下载phpexcel
     */
    public static function format_excel2array($filePath='',$sheet=0){
        if(empty($filePath) or !file_exists($filePath)){die('file not exists');}
        $PHPReader = new \PHPExcel_Reader_Excel2007();        //建立reader对象
        if(!$PHPReader->canRead($filePath)){
            $PHPReader = new \PHPExcel_Reader_Excel5();
            if(!$PHPReader->canRead($filePath)){
                echo 'no Excel';
                return false;
            }
        }
        $PHPExcel = $PHPReader->load($filePath);        //建立excel对象
        $currentSheet = $PHPExcel->getSheet($sheet);        //**读取excel文件中的指定工作表*/
        $allColumn = $currentSheet->getHighestColumn();        //**取得最大的列号*/
        $allRow = $currentSheet->getHighestRow();        //**取得一共有多少行*/
        $data = array();
        for($rowIndex=0;$rowIndex<=$allRow;$rowIndex++){        //循环读取每个单元格的内容。注意行从1开始，列从A开始
            for($colIndex='A';$colIndex<=$allColumn;$colIndex++){
                $addr = $colIndex.$rowIndex;
                $cell = $currentSheet->getCell($addr)->getValue();
                if($cell instanceof \PHPExcel_RichText){ //富文本转换字符串
                    $cell = $cell->__toString();
                }
                $data[$rowIndex][$colIndex] = $cell;
            }
        }
        return $data;
    }
}