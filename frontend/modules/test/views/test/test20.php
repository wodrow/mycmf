<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-3
 * Time: 上午9:06
 */

use kartik\form\ActiveForm;
use zh\qiniu\QiniuFileInput;
?>

<div class="frontend-test-test-test20">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin() ?>
            <?= $form->field($model, 'images')->widget(QiniuFileInput::className(),[
                //'options' => [
                //   'class' => 'btn-danger'//按钮class
                //],
                //'uploadUrl' => 'http://up-z2.qiniu.com',文件上传地址 不同地区的空间上传地址不一样 参见官方文档
                'qlConfig' => [
                    'accessKey' => '你的七牛key',
                    'secretKey' => '你的七牛secretKey',
                    'scope'=>'你的空间名',
                    'cdnUrl' => 'http://URL',//外链域名
                ],
                'clientOptions' => [
                    'max' => 5,//最多允许上传图片个数  默认为3
                    //'size' => 204800,//每张图片大小
                    //'btnName' => 'upload',//上传按钮名字
                    //'accept' => 'image/jpeg,image/gif,image/png'//上传允许类型
                ],
                //'pluginEvents' => [
                //    'delete' => 'function(item){console.log(item)}',
                //    'success' => 'function(res){console.log(res)}'
                //]
            ]) ?>
            <?php ActiveForm::end() ?>
        </div>
    </div>
</div>
