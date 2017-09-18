<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\user\models\genealogy\Group $group
 */
?>

<div class="genealogy-genealogy-_group_form">
    <?php $form = \kartik\form\ActiveForm::begin(); ?>
    <?=$form->field($group, 'title')->textInput() ?>
    <?=$form->field($group, 'mark')->textInput(['readonly'=>true]) ?>
    <?=$form->field($group, 'info')->textarea() ?>
    <?=\yii\helpers\Html::submitButton($group->isNewRecord?'创建':'修改', ['class'=>"btn btn-primary"]) ?>
    <?php \kartik\form\ActiveForm::end(); ?>
</div>

