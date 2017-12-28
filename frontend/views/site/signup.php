<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

\xutl\layui\LayuiAsset::register($this);

$this->title = Yii::t('app', 'Signup');
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="site-signup">
    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>
                <?= $form->field($model, 'email')->textInput(['name' => 'email']) ?>
                <?= $form->field($model, 'email_code')->textInput(['maxlength'=>32]) ?>
                <?= $form->field($model, 'username')->textInput() ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
                <?= $form->field($model, 'repassword')->passwordInput() ?>
                <?= $form->field($model, 'code')->widget(\yii\captcha\Captcha::className(), [
                    'imageOptions' => [
                        'alt'=>'点击换图',
                        'title'=>'点击换图',
                        'style'=>'cursor:pointer',
                    ],
                ]) ?>
                <div class="form-group">
                    <?= Html::submitButton(Yii::t('app', 'Signup'), ['class' => 'btn btn-primary', 'name' => 'signup-button']) ?>
                    <?= Html::button(Yii::t('app', 'Get Email Code'), ['class' => 'btn btn-warning', 'name' => 'get-email-code-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>

<?php \common\components\widgets\JsBlock::begin(); ?>
<script>
    jQuery(document).ready(function($) {
        $('#form-signup').find("button[name='get-email-code-button']").click(function(event) {
            var email = $('#form-signup').find("input[name='email']").val();
            if (!email){
                alert('邮箱必须填写!');
                return false;
            }
            var reg = /^([a-zA-Z0-9_-])+@([a-zA-Z0-9_-])+((\.[a-zA-Z0-9_-]{2,3}){1,2})$/;
            if (!reg.test(email)) {
                alert('邮箱格式不正确，请重新填写!');
                return false;
            }
        });
    });
</script>
<?php \common\components\widgets\JsBlock::end(); ?>
