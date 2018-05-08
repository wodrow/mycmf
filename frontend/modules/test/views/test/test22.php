<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-4
 * Time: 上午9:20
 */
?>

<div class="frontend-test-test-test21">
    <div class="row">
        <div class="col-lg-12">
            <?php echo \common\widgets\wodrow\avatar\AvatarWidget::widget([
                'model' => $model,
                'attribute' => 'image',
            ]) ?>
        </div>
    </div>
</div>
