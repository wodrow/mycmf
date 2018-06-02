<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-4
 * Time: 上午9:20
 */

use budyaga\cropper\Widget;
use kartik\form\ActiveForm;
use common\components\tools\Url;
use kartik\helpers\Html;

//echo Url::toRoute('uploadPhoto');exit;
?>

<div class="frontend-test-test-test21">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(['id' => 'form-profile']); ?>
            <?php echo $form->field($model, 'image')->widget(Widget::class, [
                'uploadUrl' => Url::toRoute('uploadPhoto'),
            ]) ?>
            <div class="form-group">
                <?php echo Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            </div>
            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
