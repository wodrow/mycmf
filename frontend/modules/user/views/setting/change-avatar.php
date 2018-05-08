<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-8
 * Time: 下午4:45
 *
 * @var \frontend\modules\user\models\FormChangeAvatar $model
 */

use kartik\form\ActiveForm;
use common\components\tools\Url;
use common\components\tools\Html;
use budyaga\cropper\Widget;
?>

<div class="frontend-user-setting-change-avatar">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-profile']); ?>
            <?php echo $form->field($model, 'avatar')->widget(Widget::className(), [
                'uploadUrl' => Url::toRoute('uploadAvatar'),
            ]) ?>
            <div class="form-group">
                <?php echo Html::submitButton('保存', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
