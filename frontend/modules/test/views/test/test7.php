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

<div class="test-test-test7">
    <div class="col-lg-12">
        <?php $form = \kartik\form\ActiveForm::begin(); ?>
        <?php echo $form->field($test,'video')->widget('yidashi\uploader\SingleWidget'); ?>
        <?php \kartik\form\ActiveForm::end(); ?>
    </div>
    <dov class="col-lg-12">

    </dov>
</div>
