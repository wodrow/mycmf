<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-4
 * Time: 上午9:20
 */

use kartik\form\ActiveForm;
use common\components\tools\Url;
use kartik\helpers\Html;
use kartik\widgets\FileInput;

?>

<div class="frontend-test-test-test21">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-profile']); ?>
            <?php
            echo $form->field($model, 'video')->widget(FileInput::classname(), [
                'options' => ['accept' => 'video/*'],
            ]);
            ?>
            <div class="form-group">
                <?php echo Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
        <div class="col-lg-12">
            <?php
            echo \wbraganca\videojs\VideoJsWidget::widget([
                'options' => [
                    'class' => 'video-js vjs-default-skin vjs-big-play-centered',
                    'poster' => "/storge/images/404.png",
                    'controls' => true,
                    'preload' => 'auto',
                    'width' => '970',
                    'height' => '400',
                ],
                'tags' => [
                    'source' => [
                        ['src' => 'http://vjs.zencdn.net/v/oceans.mp4', 'type' => 'video/mp4'],
                        ['src' => 'http://vjs.zencdn.net/v/oceans.webm', 'type' => 'video/webm']
                    ],
                    'track' => [
                        ['kind' => 'captions', 'src' => 'http://vjs.zencdn.net/vtt/captions.vtt', 'srclang' => 'en', 'label' => 'English']
                    ]
                ]
            ]);
            ?>
        </div>
    </div>
</div>
