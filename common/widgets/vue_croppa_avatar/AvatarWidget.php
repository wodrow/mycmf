<?php
namespace common\widgets\vue_croppa_avatar;


use common\widgets\vue_croppa_avatar\assets\Croppa;
use kartik\widgets\InputWidget;

class AvatarWidget extends InputWidget
{
    public function run()
    {
        Croppa::register($this->view);
        return $this->render('index');
    }
}