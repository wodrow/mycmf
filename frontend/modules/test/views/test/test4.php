<?php

?>

<?php $form = \kartik\form\ActiveForm::begin() ?>
<?=$form->field($model, 'email') ?>
<?=\yii\helpers\Html::submitButton('test') ?>
<?php \kartik\form\ActiveForm::end() ?>