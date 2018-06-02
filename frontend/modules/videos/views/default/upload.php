<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-6-2
 * Time: 下午5:06
 */
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\videos\models\FormVideoUpload $form
 */
use kartik\widgets\ActiveForm;
use kartik\widgets\FileInput;
use common\components\tools\Html;
use common\components\tools\Url;
?>

<div class="frontend-videos-default-upload">
    <div class="row">
        <div class="col-lg-12">
            <?php $_form = ActiveForm::begin(); ?>
            <?=$_form->field($form, 'video_files')->widget(FileInput::class, [
                'options'=>[
                    'multiple'=>true,
                    'accept' => "video/*",
                ],
                'pluginOptions' => [
                    'uploadUrl' => Url::to(['/videos/default/file-upload']),
                    'previewFileType' => 'video',
                    'uploadExtraData' => [
//                        'album_id' => 20,
//                        'cat_id' => 'Nature',
                    ],
                    'maxFileCount' => 20
                ],
                'pluginEvents' => [
                    // 上传成功后的回调方法，需要的可查看data后再做具体操作，一般不需要设置
                    "fileuploaded" => "function (event, data, id, index){
                        console.log(data.response);
                    }",
                ],
            ]) ?>
            <?=$_form->field($form, 'code')->widget(\yii\captcha\Captcha::class) ?>
            <div class="form-group">
                <?= Html::submitButton(Yii::t('app', '上传'), ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
