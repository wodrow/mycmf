<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-6-2
 * Time: 下午5:06
 */
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\videos\models\FormVideoUpload $model
 */
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use common\components\tools\Html;
use common\components\tools\Url;
use common\helpers\FileHelper;

$model_basename = FileHelper::classBasename($model);
?>

<div class="frontend-videos-default-upload">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(); ?>
            <?php echo $form->field($model, 'video_files')->widget(FileInput::class, [
                'options'=>[
                    'multiple' => true,
                    'accept' => "video/*",
                ],
                'pluginOptions' => [
                    'uploadUrl' => Url::to(['/videos/default/file-upload']),
                    'previewFileType' => 'video',
                    'uploadExtraData' => [
                        'model_name' => $model_basename,
                        'attr_name' => 'video_files',
                        'serial_number' => date("YmdHis_", time()).Yii::$app->user->id."_".Yii::$app->security->generateRandomString(20),
                    ],
                    'uploadAsync' => true,
                    'minFileCount' => 1,
                    'maxFileCount' => 20,
                    'showRemove' => true,
                    'showUpload' => true,
                    'showBrowse' => true,
                    'browseOnZoneClick' => true,
                    'fileActionSettings' => [
                        'showZoom' => false,
                        'showUpload' => true,
                        'showRemove' => false,
                    ],
                ],
                'pluginEvents' => [
                    "fileuploaded" => "function (event, data, id, index){
                        console.log(data.response);
                        var _v = $('input[name=\"{$model_basename}[file_ids]\"]').val();
                        _v = _v + data.response.file_id + ';';
                        $('input[name=\"{$model_basename}[file_ids]\"]').val(_v);
                    }",
                ],
            ]); ?>
            <?=$form->field($model, 'file_ids')->hiddenInput()->label(false) ?>
            <?=$form->field($model, 'code')->widget(\yii\captcha\Captcha::class) ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', '加入上传处理队列'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
