<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace frontend\widgets\wodrow\avatar;

/**
 * Description of AvatarWidget
 *
 * @author wodrow
 */
class AvatarWidget extends \kartik\widgets\Widget
{
    public function run() {
        assets\Asset::register($this->view);
        return $this->render('index');
    }
}
