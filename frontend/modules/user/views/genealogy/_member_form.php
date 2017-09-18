<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\user\models\genealogy\Member $member
 */
?>

<div class="genealogy-genealogy-_member_form">
    <h4>
        <?=$member->group->title ?>-<?=$member->isNewRecord?"添加":"修改" ?>成员
    </h4>
    <?php $form = \kartik\form\ActiveForm::begin(); ?>
    <?=$form->field($member, 'name')->textInput() ?>
    <?=$form->field($member, 'sex')->dropDownList(\common\models\Enum::getSex()) ?>
    <?=$form->field($member, 'borthday')->widget(\kartik\widgets\DatePicker::className(), [
        'options' => [],
        'pluginOptions' => [
            'autoclose' => true,
            'todayHighlight' => true,
            'format' => 'yyyy-mm-dd',
        ],
    ]) ?>
    <?=$form->field($member, 'father_id')->textInput() ?>
    <?=$form->field($member, 'mother_id')->textInput() ?>
    <?=$form->field($member, 'borth_place')->textInput() ?>
    <?=$form->field($member, 'info')->textarea() ?>
    <?=\yii\helpers\Html::submitButton($member->isNewRecord?'创建':'修改', ['class'=>"btn btn-primary"]) ?>
    <?php \kartik\form\ActiveForm::end(); ?>
</div>

