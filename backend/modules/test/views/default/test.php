<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-17
 * Time: 下午1:21
 */
/**
 * @var \backend\modules\test\models\Test $model
 */
use common\widgets\wodrow\avatar\AvatarWidget;
?>

<div class="backend-test-default-test">
    <div class="row">
        <div class="col-lg-12">
            <?php echo AvatarWidget::widget(['imageUrl' => '/uploads/404.png']); ?>
        </div>
    </div>
</div>
