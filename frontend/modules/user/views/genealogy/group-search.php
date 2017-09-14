<?php
/**
 * @var \yii\web\View $this
 * @var \frontend\modules\user\models\genealogy\Group[] $groups
 * @var \yii\data\Pagination $pages
 * @var \frontend\modules\user\models\genealogy\GroupSearchForm $search_form
 */
?>

<div class="user-genealogy-group-search">
    <div class="row">
        <div class="col-lg-12">
            <div class="row">
                <div class="search" style="margin-bottom: 10px;">
                    <?php $form = \kartik\form\ActiveForm::begin([
                        'type' => \kartik\form\ActiveForm::TYPE_INLINE,
                        'options' => []
                    ]); ?>
                    <?=$form->field($search_form, 'mark')->textInput() ?>
                    <?=$form->field($search_form, 'title')->textInput() ?>
                    <?=$form->field($search_form, 'info')->textInput() ?>
                    <?=\yii\helpers\Html::submitButton('搜索', ['class'=>"btn btn-primary"]) ?>
                    <?php \kartik\form\ActiveForm::end(); ?>
                </div>
                <div class="items">
                    <?php foreach($groups as $k => $v): ?>
                        <div class="item-list">
                            <?=$v->info ?>
                        </div>
                    <?php endforeach; ?>
                </div>
                <div class="pages">
                    <?=\yii\widgets\LinkPager::widget([
                        'pagination' => $pages,
                        /*'firstPageLabel' => '首页',
                        'lastPageLabel' => '尾页',
                        'prevPageLabel' => '上一页',
                        'nextPageLabel' => '下一页',
                        'maxButtonCount' => 10, //控制每页显示的页数*/
                    ]) ?>
                </div>
            </div>
        </div>
    </div>
</div>
