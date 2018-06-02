<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-6-2
 * Time: 下午4:57
 */

namespace frontend\modules\videos\controllers;


use common\components\budget\Local;
use common\models\db\Budget;
use common\models\db\Files;
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
        $old_file_name = $file['name'][$attr_name];
        $file_tpye = $file['type'][$attr_name];
        $tmp_file = $file['tmp_name'][$attr_name];
        $file_size = $file['size'][$attr_name];
        $_tmp_file = \Yii::getAlias('@storage_root')."/tmp/{$old_file_name}";
        rename($tmp_file, $_tmp_file);
        exit;
        $file = new Files();
        $budget = Budget::findOne(['name'=>Local::NAME]);
        $file->budget_id = $budget->id;
        $file->type = $file::TYPE_IMAGE;
        $file->status = $file::STATUS_ACTIVE;
        $file->func_for = $file::FUNC_FOR_VIDEO_UPLOAD;
        $data = $budget->operator->uploadLocalFile($tmp_file);
        $file->initDataByBudgetResp($data);
//        $file->save(false);
        $out = [];
        return $out;
    }
}