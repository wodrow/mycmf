<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-5-11
 * Time: 下午3:24
 */

/**
 * @var \yii\web\View $this
 */

use common\components\tools\Html;
?>

<div class = "input-group" style = "margin-top:.5em;">
    <?=Html::img($src, ['class' => 'img-responsive img-thumbnail cus-img']); ?>
    <?=Html::tag('em', 'x', ['class' => 'close delImage', 'title' => '删除这张图片']) ?>
</div>
