<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-4
 * Time: 上午9:20
 */

/**
 * @var \common\models\db\Test $model
 */
use kartik\form\ActiveForm;
use common\components\tools\Url;
use kartik\helpers\Html;
use kartik\widgets\FileInput;

?>

<div class="frontend-test-test-test21">
    <div class="row">
        <div class="col-lg-12">
            <?php
            echo FileInput::widget([
                'model' => $model,
                'attribute' => 'video',
                'options' => ['accept' => 'video/*'],
            ]);
            ?>
            <div class="form-group">
                <?php echo Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
        </div>
        <div class="col-lg-12">
            <?php
            echo \wbraganca\videojs\VideoJsWidget::widget([
                'options' => [
                    'class' => 'vjs-default-skin vjs-big-play-centered',
                    'poster' => "/storge/images/404.png",
                    'controls' => true,
                    'preload' => 'auto',
                    'width' => '100%',
                    'height' => '400',
                ],
                'tags' => [
                    'source' => [
//                        ['src' => 'http://vjs.zencdn.net/v/oceans.mp4', 'type' => 'video/mp4'],
                        ['src' => Yii::getAlias('@wurl').'/storge/tmp/2018-03-17-164346.webm', 'type' => 'video/webm']
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
