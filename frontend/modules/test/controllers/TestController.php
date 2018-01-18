<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 2017/9/25
 * Time: 下午 2:06
 */

namespace frontend\modules\test\controllers;


use common\models\db\Test;
use frontend\models\GetEmailCodeForm;
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
            var_dump($_REQUEST);
            exit;
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
            \Yii::$app->session->addFlash('info', var_export($_REQUEST, true));
//            \Yii::$app->session->addFlash('info', var_export($model->toArray(), true));
//            \Yii::$app->session->addFlash('info', var_export($model->attachment, true));
//            exit;
        }
        return $this->render('test3', ['model' => $model]);
    }

    public function actionTest3FileUpload()
    {
        $model_name = \Yii::$app->request->post('model_name');
        $attr_name = \Yii::$app->request->post('attr_name');
        \Yii::$app->response->format = 'json';
        if (empty($_FILES['Test1'])) {
            return ['error'=>'没有找到上传的文件.'];
        }
        $file = $_FILES[$model_name];
        $filenames = $file['name'];
        $success = null;
        $paths = [];
        foreach ($filenames as $k => $v){
            $ext = explode('.', basename($filenames[$k][0]));
            $target = \Yii::getAlias("@wroot/uploads").DIRECTORY_SEPARATOR."test" . DIRECTORY_SEPARATOR . md5(uniqid()) . "." . array_pop($ext);
            if(move_uploaded_file($file['tmp_name'][$k][0], $target)) {
                $success = true;
                $paths[] = $target;
            } else {
                $success = false;
                break;
            }
        }
        if ($success === true) {
            $out = ['test'=>'test'];
        } elseif ($success === false) {
            $out = ['error'=>"上传失败，请联系站长"];
            foreach ($paths as $file) {
                unlink($file);
            }
        } else {
            $out = ['error'=>'没有进行上传'];
        }
        return $out;
    }

    public function actionTest4()
    {
        $model = new GetEmailCodeForm();
        if ($model->load(\Yii::$app->request->post())){
            var_dump($model->toArray());
            var_dump($model->toArray());
            var_dump($model->toArray());
        }
        return $this->render('test4', [
            'model' => $model,
        ]);
    }

    public function actionTest5()
    {
        $test = new Test();
        return $this->render('test5', [
            'test' => $test,
        ]);
    }

    public function actionTest6()
    {
        $test = new Test();
        return $this->render('test6', [
            'test' => $test,
        ]);
    }

    public function actionTest7()
    {
        $test = new Test();
        return $this->render('test7', [
            'test' => $test,
        ]);
    }
}