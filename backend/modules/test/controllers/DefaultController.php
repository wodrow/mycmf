<?php

namespace backend\modules\test\controllers;

use backend\modules\test\models\Test;
use common\models\test\Tree;
use common\widgets\wodrow\avatar\CropAction;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;

/**
 * Default controller for the `test` module
 */
class DefaultController extends Controller
{
    public function actions()
    {
        return [
            'crop'=>[
                'class' => CropAction::className(),
                'config'=>[
                    'bigImageWidth' => '200',     //大图默认宽度
                    'bigImageHeight' => '200',    //大图默认高度
                    'middleImageWidth'=> '100',   //中图默认宽度
                    'middleImageHeight'=> '100',  //中图图默认高度
                    'smallImageWidth' => '50',    //小图默认宽度
                    'smallImageHeight' => '50',   //小图默认高度

                    //头像上传目录（注：目录前不能加"/"）
                    'uploadPath' => 'uploads/avatar',
                ],
                'baseUrl' => '@wurl/uploads/avatar',//访问目录
                'basePath' => '@wroot/uploads/avatar',//磁盘目录
            ]
        ];

    }

    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect('test/default/test');
//        return $this->render('index');
    }

    public function actionTest()
    {
        $model = new Test();
        $model->image = 'test';
        return $this->render('test', [
            'model' => $model,
        ]);
    }

    public function actionTest1()
    {
        $query = Tree::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => false
        ]);

        return $this->render('test1', [
            'dataProvider' => $dataProvider
        ]);
    }

    public function actionTest2()
    {
        return $this->render('test2');
    }

    public function actionTest3()
    {
        #
    }
}
