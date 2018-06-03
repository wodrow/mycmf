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
use common\components\tools\ArrayHelper;

class DefaultController extends Controller
{
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionUpload()
    {
        $form = new FormVideoUpload();
        if (\Yii::$app->request->isPost){
            $form->load(\Yii::$app->request->post());
            if ($form->validate()){
                $video_ids = $form->file_ids;
                $video_ids_arr = ArrayHelper::str2arr($video_ids, ";");
                foreach ($video_ids_arr as $k => $v){
                    $video = Files::findOne($v);
                    $video->status = Files::STATUS_TO_BE_TRANSCODE;
                    $video->save();
                }
            }
            \Yii::$app->session->addFlash('success', "添加上传处理队列成功!");
            return $this->redirect(['/videos']);
        }
        return $this->render('upload', [
            'model'=>$form,
        ]);
    }

    public function actionFileUpload()
    {
        \Yii::$app->response->format = Response::FORMAT_JSON;
        $model_name = \Yii::$app->request->post('model_name');
        $attr_name = \Yii::$app->request->post('attr_name');
        $serial_number = \Yii::$app->request->post('serial_number');
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
        $file = new Files();
        $budget = Budget::findOne(['name'=>Local::NAME]);
        $file->budget_id = $budget->id;
        $file->type = $file::TYPE_VIDEO;
        $file->status = $file::STATUS_UPLOAD;
        $file->func_for = $file::FUNC_FOR_VIDEO_UPLOAD;
        $file->size = $file_size;
        $file->content_type = $file_tpye;
        $file->filename = $old_file_name;
        $f = Files::findOne(['budget_id'=>$file->budget_id, 'filename'=>$file->filename]);
        if ($f){
            $file = $f;
        }else{
            $data = $budget->operator->uploadLocalFile($_tmp_file);
            $file->initDataByBudgetResp($data);
            $file->save(false);
        }
        $out = ['file_id'=>$file->id];
        return $out;
    }
}