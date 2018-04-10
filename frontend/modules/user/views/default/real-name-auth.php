<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-9
 * Time: 下午2:01
 *
 * @var \common\models\db\UserRealNameAuth $model
 */

use kartik\helpers\Html;
use kartik\form\ActiveForm;

$this->title = "实名认证";
$this->params['breadcrumbs'][] = Html::a('用户中心', ['/user']);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="frontend-user-default-real-name-auth">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(); ?>
            <?=$form->field($model, 'name')->textInput() ?>
            <?=$form->field($model, 'id_card_number')->textInput() ?>
            <?=$form->field($model, 'id_card_front_image')->textInput() ?>
            <?=$form->field($model, 'id_card_back_image')->textInput() ?>
            <?=$form->field($model, 'id_card_front_and_face_image')->textInput() ?>
            <?=Html::submitButton('提交', ['class' => "btn btn-primary"]) ?>
            <?=Html::resetButton('重置', ['class' => "btn btn-warning"]) ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
