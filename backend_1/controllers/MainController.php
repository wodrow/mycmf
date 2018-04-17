<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-17
 * Time: 上午10:52
 */

namespace backend_1\controllers;


use yii\web\Controller;

class MainController extends Controller
{
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->renderPartial('index');
    }

    public function actionSystem()
    {
        return $this->render('system');
    }
}