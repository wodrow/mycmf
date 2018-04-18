<?php
/**
 * @var \yii\web\View $this
 */

use kartik\helpers\Html;
use kartik\form\ActiveForm;

$this->title = "账号设置";
$this->params['breadcrumbs'][] = Html::a('用户中心', ['/user']);
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="user-setting-index">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(); ?>
            <?=\common\widgets\wodrow\avatar\AvatarWidget::widget([
                'imageUrl' => "/uploads/404.png ",
//                'model' => $model,
//                'attribute' => 'avatar',
            ]) ?>
            <?=Html::submitButton('修改', ['class' => "btn btn-primary"]); ?>
            <?=Html::resetButton('撤销', ['class' => "btn btn-warning"]); ?>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
