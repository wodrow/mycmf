<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-9
 * Time: 下午12:54
 */

namespace frontend\modules\user\controllers;


use yii\web\Controller;

class SellerController extends Controller
{
    public function actionBecomeSeller()
    {
        return $this->render('become-seller');
    }
}