<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $get_email_code_form \frontend\models\FormGetEmailCode */
/* @var $model \frontend\models\FormSignup */
/**
 * @var $wait
 */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

//\xutl\layui\LayuiAsset::register($this);

$this->title = Yii::t('app', 'Reset Password');
$this->params['breadcrumbs'][] = $this->title;
?>

    <div class="site-signup">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <?php \yii\widgets\Pjax::begin(); ?>
            <div class="col-lg-5">
                <?php $form = ActiveForm::begin(['id' => 'form-get-email-code']); ?>
                <?= $form->field($get_email_code_form, 'email') ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Get Email Code'), ['class' => 'btn btn-warning layui-btn', 'name' => 'get-email-code-button', 'disabled'=>true]) ?>
                </div>
                <?php ActiveForm::end(); ?>
                <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'email_code')->textInput(['maxlength' => 32]) ?>
                <?= $form->field($model, 'password')->passwordInput(['maxlength' => 18]) ?>
                <?= $form->field($model, 'repassword')->passwordInput(['maxlength' => 18]) ?>
                <?= $form->field($model, 'code')->widget(\yii\captcha\Captcha::className(), [
                    'imageOptions' => [
                        'alt' => '点击换图',
                        'title' => '点击换图',
                        'style' => 'cursor:pointer',
                    ],
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Reset Password'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                </div>
                <?php ActiveForm::end(); ?>
            </div>
            <?php \yii\widgets\Pjax::end(); ?>
        </div>
    </div>

<?php \common\components\widgets\JsBlock::begin() ?>
    <script>
        jQuery(document).ready(function($) {
            var wait = "<?=$wait ?>";
            function _show_wait(wait) {
                if (wait > 0) {
                    var text = wait+"秒后可以重试";
                    $("button[name='get-email-code-button']").text(text);
                    $("button[name='get-email-code-button']").attr('disabled', true);
                    wait--;
                    setTimeout(function () {
                        _show_wait(wait)
                    }, 1000)
                }else{
                    $("button[name='get-email-code-button']").text("<?=Yii::t('app', 'Get Email Code') ?>");
                    $("button[name='get-email-code-button']").attr('disabled', false);
                }
            }
            _show_wait(wait);
        });
    </script>
<?php \common\components\widgets\JsBlock::end() ?>