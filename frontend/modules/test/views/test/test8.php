<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-18
 * Time: 下午4:14
 * @var \yii\web\View $this
 * @var \common\models\db\Test $test
 */

use kartik\helpers\Html;
?>

<div class="test-test-test7">
    <div class="col-lg-12">
        <?php $form = \kartik\form\ActiveForm::begin([
            'options'=>['enctype'=>'multipart/form-data'],
        ]); ?>
        <?php echo $form->field($test,'file')->widget(\kartik\widgets\FileInput::className(), [
            'options' => [
                'accept' => 'video/*',
                'multiple' => false,
            ],
            'pluginOptions'=>[
                'showUpload' => false,
            ],
        ]); ?>
        <?= Html::submitButton($test->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $test->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        <?php \kartik\form\ActiveForm::end(); ?>
    </div>
    <dov class="col-lg-12">

    </dov>
</div>
