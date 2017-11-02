<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\test\models\Test1 $model
 */
?>

<div class="test-test-test2">
    <?php $form = \kartik\form\ActiveForm::begin(); ?>
    <?=$form->field($model, 'text')->textInput(); ?>
    <?=$form->field($model, 'json')->textInput(); ?>
    <?=\yii\helpers\Html::submitButton('submit', ['class'=>"btn btn-primary"]) ?>
    <?=\yii\helpers\Html::resetButton('reset', ['class'=>"btn btn-danger"]) ?>
    <?php \kartik\form\ActiveForm::end(); ?>
</div>
