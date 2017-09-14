<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\user\models\genealogy\Group $group
 */
?>

<div class="user-genealogy-group-create">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = \kartik\form\ActiveForm::begin(); ?>
            <?=$form->field($group, 'title')->textInput() ?>
            <?=$form->field($group, 'mark')->textInput(['readonly'=>true]) ?>
            <?=$form->field($group, 'info')->textarea() ?>
            <?=\yii\helpers\Html::submitButton('创建', ['class'=>"btn btn-primary"]) ?>
            <?php \kartik\form\ActiveForm::end(); ?>
        </div>
    </div>
</div>
