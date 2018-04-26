<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-12
 * Time: 下午5:03
 */

/**
 * @var \frontend\models\FormUpload $model
 * @var \yii\web\View $this
 */
use kartik\form\ActiveForm;
use kartik\helpers\Html;
?>

<div class="frontend-site-upload">
    <div class="row">
        <div class="col-lg-12">
            <?php $form = ActiveForm::begin(); ?>
            <?=$form->field($model, 'file')->fileInput() ?>
            <?=Html::submitButton('submit', ['class' => "btn btn-primary"]) ?>
            <?php ActiveForm::end(); ?>
        </div>

        <div class="col-lg-12">
            <form action="https://sm.ms/api/upload" method="post" enctype="multipart/form-data">
                <input type="file" name="smfile">
                <?=Html::submitButton('submit', ['class' => "btn btn-primary"]) ?>
            </form>
        </div>
    </div>
</div>
