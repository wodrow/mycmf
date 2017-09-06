<?php

namespace backend\modules\test\controllers;

use common\models\test\Tree;
use yii\data\ActiveDataProvider;
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
}
