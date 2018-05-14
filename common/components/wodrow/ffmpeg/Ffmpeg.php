<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-14
 * Time: 下午4:52
 */

namespace common\components\wodrow\ffmpeg;


use yii\base\Component;
use Yii;

class Ffmpeg extends Component
{
    public $path='ffmpeg';
    public $type; // 'audio/video/image';
    public $input_file; // '/home/user/Pictures/movie.mp4'
    public $output_file; //  '/home/user/Pictures/movie.mov'
    public $audio_bit_rate='20k';
    public $video_bit_rate='20k';
    public $thumbnail_image; // '/home/user/Pictures/movie.gif'
    public $thumbnail_generation; // 'yes/no'
    public $thumbnail_size='100x100';

    public function ffmpeg()
    {
        $ffmpeg = Yii::$app->ffmpeg->path;
        $video_bit_rate = '';
        $audio_bit_rate = '';
        $thumb_nail_size = '';
        $type = ! empty( $this->type ) ? $this->type : '';
        $input_file = ! empty( $this->input_file ) ? $this->input_file : '';
        $target_file = ! empty( $this->output_file ) ? $this->output_file : '';
        $audio_bitrate = ! empty( $this->audio_bit_rate ) ? $this->audio_bit_rate : '';
        $video_bitrate = ! empty( $this->video_bit_rate ) ? $this->video_bit_rate : '';
        $thumbnail_image = ! empty( $this->thumbnail_image ) ? $this->thumbnail_image : '';
        $thumbnail_size = ! empty( $this->thumbnail_size ) ? $this->thumbnail_size : '';
        $thumbnail_generation = ! empty( $this->thumbnail_generation ) ? $this->thumbnail_generation : '';
        if ($video_bitrate != '') {
            $video_bit_rate = '-b:v '.$video_bitrate;
        }
        if ($audio_bitrate != '') {
            $audio_bit_rate = '-b:a '.$audio_bitrate;
        }
        if ($thumbnail_size != '' && $type == 'video') {
            $thumb_nail_size = '-s '.$thumbnail_size;
        }
        if ($thumbnail_size != '' && $type == 'image') {
            $thumb_nail_size = $thumbnail_size;
        }
        if ($type != '') {
            if ($type == 'video') {
                $cmd = "$ffmpeg -y -i $input_file -c:v libx264 $video_bit_rate $audio_bit_rate -strict -2 $target_file";
                exec($cmd,$results);
            } else if ($type == 'audio') {
                $cmd = "$ffmpeg -y -i $input_file $audio_bit_rate $target_file";
                exec($cmd,$results);
            } else if ($type == 'image') {
                $cmd = "$ffmpeg -y -i $input_file -f image2 $target_file";
                exec($cmd,$results);
            }
            //thumbnail
            if ($thumbnail_generation == 'yes') {
                if ($type == 'video' || $type == 'image') {
                    if ($thumbnail_size != '') {
                        if ($type == 'video') {
                            $cmd2 = "$ffmpeg -y -i $input_file -t 1 $thumb_nail_size -f image2 $thumbnail_image";
                            exec($cmd2,$results);
                        }
                        if ($type == 'image') {
                            $cmd2 = "$ffmpeg -y -i $input_file -vf scale=".$thumb_nail_size." $thumbnail_image";
                            exec($cmd2,$results);
                        }
                    }
                }
            }
            return true;
        } else {
            echo 'Please check parameters you provided. Try again';exit;
        }

    }
}