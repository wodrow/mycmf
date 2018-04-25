<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\widgets\wodrow\avatar;
use kartik\widgets\Widget;


/**
 * Description of AvatarWidget
 *
 * @author wodrow
 */
class AvatarWidget extends Widget
{
    public $avatar_url = '/images/404.png';

    public function run() {
        assets\Asset::register($this->view);
        $model = new FormAvatar();
        return $this->render('index', [
            'avatar_url' => $this->avatar_url,
            'model' => $model,
        ]);
    }
}
