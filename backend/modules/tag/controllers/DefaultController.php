<?php

namespace backend\modules\tag\controllers;

use yii\web\Controller;

/**
 * Default controller for the `tag` module
 */
class DefaultController extends Controller
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->redirect(['/tag/tag']);
//        return $this->render('index');
    }
}
