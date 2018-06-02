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
                        'model_name' => FileHelper::classBasename($model),
                        'attr_name' => 'video_files',
                        'serial_number' => date("YmdHis_", time()).Yii::$app->user->id."_".Yii::$app->security->generateRandomKey(20),
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
                    }",
                ],
            ]); ?>
            <?=$form->field($model, 'code')->widget(\yii\captcha\Captcha::class) ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', '上传'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
