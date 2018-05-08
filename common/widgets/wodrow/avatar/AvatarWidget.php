<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-8
 * Time: 下午3:20
 */

namespace common\widgets\wodrow\avatar;


use common\widgets\wodrow\avatar\assets\Jcrop;
use kartik\widgets\InputWidget;

class AvatarWidget extends InputWidget
{
    public function run()
    {
        Jcrop::register($this->view);
        return $this->render('index');
    }
}