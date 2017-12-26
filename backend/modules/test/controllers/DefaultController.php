<?php

namespace backend\modules\test\controllers;


use common\models\test\Tree;
use yii\data\ActiveDataProvider;
use yii\db\Query;
use yii\web\Controller;

/**
 * Default controller for the `test` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionTest()
    {
        echo 123456798;
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
}
