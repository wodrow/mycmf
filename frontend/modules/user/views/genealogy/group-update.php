<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\user\models\genealogy\Group $group
 */
?>

<div class="user-genealogy-group-update">
    <div class="row">
        <div class="col-lg-12">
            <?=$this->render('_group_form', ['group'=>$group]) ?>
        </div>
    </div>
</div>
