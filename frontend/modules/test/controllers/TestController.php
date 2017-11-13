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
        var_dump($_FILES);
        var_dump($_REQUEST);
        exit;
        // 商品ID
        $id = 1;
        // $p1 $p2是我们处理完图片之后需要返回的信息，其参数意义可参考上面的讲解
        $p1 = $p2 = [];
        // 如果没有商品图或者商品id非真，返回空
        if (empty($_FILES)) {
            echo '{}';
            return;
        }
        // 循环多张商品banner图进行上传和上传后的处理
        for ($i = 0; $i < count($_FILES['Test1']['name']['attachment']); $i++) {
            // 上传之后的商品图是可以进行删除操作的，我们为每一个商品成功的商品图指定删除操作的地址
            $url = '/test/test/test3-attachment-delete';
            // 调用图片接口上传后返回的图片地址，注意是可访问到的图片地址哦
            $imageUrl = '';
            // 保存商品banner图信息
//            $model = new Test1;
//            $model->goods_id = $id;
//            $model->banner_url = $imageUrl;
            $model = Test1::findOne(['id'=>$id]);
            $model->attachment = $imageUrl;
            $key = 0;
            if ($model->save(false)) {
                $key = $model->id;
            }
            // 这是一些额外的其他信息，如果你需要的话
            // $pathinfo = pathinfo($imageUrl);
            // $caption = $pathinfo['basename'];
            // $size = $_FILES['Test1']['size']['banner_url'][$i];
            $p1[$i] = $imageUrl;
            $p2[$i] = ['url' => $url, 'key' => $key];
        }
        // 返回上传成功后的商品图信息
        echo json_encode([
            'initialPreview' => $p1,
            'initialPreviewConfig' => $p2,
            'append' => true,
        ]);
        return;
    }
}