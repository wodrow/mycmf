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
use common\helpers\FileHelper;
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
                        'model_name' => FileHelper::classBasename($form),
                        'attr_name' => 'video_files',
                    ],
                    'uploadAsync' => true,
                    // 最少上传的文件个数限制
                    'minFileCount' => 1,
                    // 最多上传的文件个数限制
                    'maxFileCount' => 20,
                    // 是否显示移除按钮，指input上面的移除按钮，非具体图片上的移除按钮
                    'showRemove' => true,
                    // 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
                    'showUpload' => true,
                    //是否显示[选择]按钮,指input上面的[选择]按钮,非具体图片上的上传按钮
                    'showBrowse' => true,
                    // 展示图片区域是否可点击选择多文件
                    'browseOnZoneClick' => true,
                    // 如果要设置具体图片上的移除、上传和展示按钮，需要设置该选项
                    'fileActionSettings' => [
                        // 设置具体图片的查看属性为false,默认为true
                        'showZoom' => false,
                        // 设置具体图片的上传属性为true,默认为true
                        'showUpload' => true,
                        // 设置具体图片的移除属性为true,默认为true
                        'showRemove' => false,
                    ],
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
