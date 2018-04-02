<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-2
 * Time: 上午11:58
 */

namespace frontend\modules\utils\controllers;


use frontend\modules\utils\models\DoubleTextForm;
use yii\web\Controller;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionSerializeTool()
    {
        $form = new DoubleTextForm();
        if ($form->load(\Yii::$app->request->post())&&$form->validate()){
            if ($form->form_up){
                $form->form_dowm = unserialize($form->form_up);
            }
        }
        return $this->render('serialize-tool', ['form' => $form]);
    }
}