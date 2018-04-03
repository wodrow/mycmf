<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 8/16/17
 * Time: 10:15 AM
 */

namespace common\rewrite\web;

use common\config\Env;
use Yii;
use yii\web\IdentityInterface;

/**
 * Class User
 * @package common\rewrite\web
 *
 * @property \common\models\User $identity
 */
class User extends \yii\web\User
{
    public $isInConsole = false;

    public function login(IdentityInterface $identity, $duration = 0)
    {
        if ($this->beforeLogin($identity, false, $duration)) {
            $this->switchIdentity($identity, $duration);
            $id = $identity->getId();
            $ip = $this->isInConsole?'0.0.0.0':Yii::$app->getRequest()->getUserIP();
            if ($this->enableSession) {
                $log = "User '$id' logged in from $ip with duration $duration.";
            } else {
                $log = "User '$id' logged in from $ip. Session not enabled.";
            }
            Yii::info($log, __METHOD__);
            $this->afterLogin($identity, false, $duration);
        }

        return !$this->getIsGuest();
    }
}