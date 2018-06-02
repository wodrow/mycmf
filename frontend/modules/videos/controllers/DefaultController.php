<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-6-2
 * Time: 下午4:57
 */

namespace frontend\modules\videos\controllers;


use frontend\modules\videos\models\FormVideoUpload;
use yii\web\Controller;
use yii\web\Response;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpload()
    {
        $form = new FormVideoUpload();
        return $this->render('upload', [
            'form'=>$form,
        ]);
    }

    public function actionFileUpload()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $out = [];
        return $out;
    }
}