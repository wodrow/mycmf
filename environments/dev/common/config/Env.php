<?php

namespace common\config;


use yii\base\Component;

class Env extends Component
{
    const VERSION = '0.1';
    const DOMAIN = DOMAIN;
    const HOME_URL = "http://".self::DOMAIN;
    const BACKEND_URL = self::HOME_URL."/backend";
    const API_URL = self::HOME_URL."/api";
    const CONSOLE_USERNAME = '';
}