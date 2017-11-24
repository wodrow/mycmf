<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 2017/9/25
 * Time: 下午 2:06
 */

namespace frontend\modules\test\controllers;


use frontend\modules\test\models\Test1;
use Phpml\Association\Apriori;
use yii\web\Controller;

class TestController extends Controller
{
    public function actionTest()
    {
        $samples = [['1', '2', '5'], ['1', '2', '8'], ['1', '2', '5'], ['1', '2', '8']];
        $labels  = [];
        $associator = new Apriori($support = 0.5, $confidence = 0.5);
        $associator->train($samples, $labels);
        $x = $associator->predict(['1','5']);
        var_dump($x);
    }

    public function actionTest1()
    {
        return $this->render('test1');
    }

    public function actionTest2()
    {
        $model = new Test1();
        if ($model->load(\Yii::$app->request->post())){
            if ($model->save()){
                var_dump($model->toArray());
            }else{
                var_dump($model->getErrors());
            }
        }
        return $this->render('test2', [
            'model' => $model,
        ]);
    }

    public function actionTest3()
    {
        $model = new Test1();
        if ($model->load(\Yii::$app->request->post())){
            \Yii::$app->session->addFlash('info', var_export($model->toArray(), true));
            \Yii::$app->session->addFlash('info', var_export($model->attachment, true));
        }
        return $this->render('test3', ['model' => $model]);
    }



    public function actionTest3FileUpload()
    {
        \Yii::$app->response->format = 'json';
        $out = [];
        if (empty($_FILES['Test1'])) {
            return ['error'=>'没有找到上传的文件.'];
        }
        $file = $_FILES['Test1'];
        $filenames = $file['name'];
        $success = null;
        $paths = [];
        foreach ($filenames as $k => $v){
            $ext = explode('.', basename($filenames[$k][0]));
            $target = \Yii::getAlias("@wroot").DIRECTORY_SEPARATOR."uploads" . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            if(move_uploaded_file($file['tmp_name'][$k][0], $target)) {
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
        } elseif ($success === false) {
            $out = ['error'=>'Error while uploading images. Contact the system administrator'];
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $out = ['error'=>'No files were processed.'];
        }
        return $out;
    }
}