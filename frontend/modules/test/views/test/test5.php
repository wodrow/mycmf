<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-18
 * Time: 下午4:14
 * @var \yii\web\View $this
 * @var \common\models\db\Test $test
 */
?>

<div class="test-test-test5">
    <div class="col-lg-12">
        <?php $form = \kartik\form\ActiveForm::begin(); ?>
        <?php // $form->field($test, 'vedio')->widget(\dosamigos\fileupload\FileUpload::class); ?>
        <?php \kartik\form\ActiveForm::end(); ?>
    </div>
    <dov class="col-lg-12">
        <?= \dosamigos\fileupload\FileUploadUI::widget([
            'model' => $test,
            'attribute' => 'image',
            'url' => ['media/upload', 'id' => 1],
            'gallery' => false,
            'options' => [
                'multiple' => false,
            ],
            'fieldOptions' => [
                'accept' => 'video/*',
            ],
            'clientOptions' => [
                'maxFileSize' => 50*1024*1024,
                'maxNumberOfFiles' => 1,
//                'messages' => [
//                    'maxFileSize' => "test",
//                    'maxNumberOfFiles' => "123",
//                ],
            ],
            // ...
            'clientEvents' => [
                'fileuploaddone' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
                'fileuploadfail' => 'function(e, data) {
                                console.log(e);
                                console.log(data);
                            }',
            ],
        ]); ?>
    </dov>
</div>
