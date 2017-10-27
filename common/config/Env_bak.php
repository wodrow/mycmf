<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 8/16/17
 * Time: 11:01 AM
 */

namespace common\config;


class Env
{
    const VERSION = '0.1';
    const DOMAIN = 'mycmf.deepin.me.tt';
    const HOME_URL = "http://".self::DOMAIN;
    const BACKEND_URL = self::HOME_URL."/backend";
}