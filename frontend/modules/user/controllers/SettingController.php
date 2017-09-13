<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/13/17
 * Time: 11:24 AM
 */

namespace frontend\modules\user\controllers;


use yii\web\Controller;

class SettingController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }
}