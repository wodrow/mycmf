<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-7
 * Time: 下午10:27
 *
 * @var \yii\web\View $this
 * @var \frontend\modules\crawler\models\TieBaStoryForm $model
 * @var \frontend\modules\crawler\models\TieBaStorySaveForm $save_form
 */
?>

<div class="crawler-tie-ba-get-tie-ba-story">
    <div class="row">
        <div class="col-lg-3">
            <?php $form = \kartik\form\ActiveForm::begin(); ?>
            <?=$form->field($model, 'url')->textInput() ?>
            <?=$form->field($model, 'waters')->textInput() ?>
            <?=\kartik\helpers\Html::submitButton('提交', ['class'=>"btn btn-primary"]) ?>
            <?php \kartik\form\ActiveForm::end(); ?>
        </div>
        <div class="col-lg-9">
            <?php $form = \kartik\form\ActiveForm::begin(); ?>
            <?=$form->field($save_form, 'title')->textInput() ?>
            <?=$form->field($save_form, 'contents')->widget(\yii\redactor\widgets\Redactor::class) ?>
            <?=\kartik\helpers\Html::submitButton('提交', ['class'=>"btn btn-primary"]) ?>
            <?php \kartik\form\ActiveForm::end(); ?>
        </div>
    </div>
</div>
