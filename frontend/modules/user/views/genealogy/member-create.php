<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\user\models\genealogy\Member $member
 */
?>

<div class="user-genealogy-group-create">
    <div class="row">
        <div class="col-lg-12">
            <?=$this->render('_member_form', ['member'=>$member]) ?>
        </div>
    </div>
</div>
