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
        $model_name = \Yii::$app->request->post('model_name');
        $attr_name = \Yii::$app->request->post('attr_name');
        if (empty($_FILES[$model_name])) {
            return ['error'=>'没有找到上传的文件.'];
        }
        $file = $_FILES[$model_name];
        var_dump($file);
        $filenames = $file['name'];
        var_dump($filenames);
        exit;
        $out = [];
        return $out;
    }
}