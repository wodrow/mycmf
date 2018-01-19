<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-19
 * Time: 下午2:29
 */

namespace common\components\tools;


class VideoHelp
{
    const FFMPEG_PATH = 'ffmpeg -i "%s" 2>&1';
    /**
     * FFmpeg获得视频文件的缩略图
     * @param $file
     * @param $time
     * @param $name
     */
    public static function getVideoCover($file,$time,$name) {
        if(empty($time))$time = '1';//默认截取第一秒第一帧
        $strlen = strlen($file);
        // $videoCover = substr($file,0,$strlen-4);
        // $videoCoverName = $videoCover.'.jpg';//缩略图命名
        //exec("ffmpeg -i ".$file." -y -f mjpeg -ss ".$time." -t 0.001 -s 320x240 ".$name."",$out,$status);
        $str = "ffmpeg -i ".$file." -y -f mjpeg -ss 3 -t ".$time." -s 320x240 ".$name;
        //echo $str."</br>";
        $result = system($str);
        return $result;
    }

    /**
     * Fmpeg读取视频播放时长和码率
     * @param $file
     * @return array
     */
    public static function getVideoInfo($file) {

        $command = sprintf(self::FFMPEG_PATH, $file);

        ob_start();
        passthru($command);
        $info = ob_get_contents();
        ob_end_clean();

        $data = array();
        if (preg_match("/Duration: (.*?), start: (.*?), bitrate: (\d*) kb\/s/", $info, $match)) {
            $data['duration'] = $match[1]; //播放时间
            $arr_duration = explode(':', $match[1]);
            $data['seconds'] = $arr_duration[0] * 3600 + $arr_duration[1] * 60 + $arr_duration[2]; //转换播放时间为秒数
            $data['start'] = $match[2]; //开始时间
            $data['bitrate'] = $match[3]; //码率(kb)
        }
        if (preg_match("/Video: (.*?), (.*?), (.*?)[,\s]/", $info, $match)) {
            $data['vcodec'] = $match[1]; //视频编码格式
            $data['vformat'] = $match[2]; //视频格式
            $data['resolution'] = $match[3]; //视频分辨率
            $arr_resolution = explode('x', $match[3]);
            $data['width'] = $arr_resolution[0];
            $data['height'] = $arr_resolution[1];
        }
        if (preg_match("/Audio: (\w*), (\d*) Hz/", $info, $match)) {
            $data['acodec'] = $match[1]; //音频编码
            $data['asamplerate'] = $match[2]; //音频采样频率
        }
        if (isset($data['seconds']) && isset($data['start'])) {
            $data['play_time'] = $data['seconds'] + $data['start']; //实际播放时间
        }
        $data['size'] = filesize($file); //文件大小
        return $data;
    }

    /**
     * Fmpeg获得视频文件的总长度时间和创建时间
     * @param $file
     * @return array
     */
    public static function getTime($file){
        $vtime = exec("ffmpeg -i ".$file." 2>&1 | grep 'Duration' | cut -d ' ' -f 4 | sed s/,//");//总长度
        $ctime = date("Y-m-d H:i:s",filectime($file));//创建时间
        //$duration = explode(":",$time);
        // $duration_in_seconds = $duration[0]*3600 + $duration[1]*60+ round($duration[2]);//转化为秒
        return array('vtime'=>$vtime,
            'ctime'=>$ctime
        );
    }
}