<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-18
 * Time: 下午4:14
 * @var \yii\web\View $this
 * @var \common\models\db\Test $test
 */
?>

<div class="test-test-test10">
    <div class="col-lg-12">
        <embed src="http://player.youku.com/player.php/sid/XMzI1NzEyMTAwNA/v.swf" quality="high" width="480"
               height="400" align="middle" allowScriptAccess="sameDomain" type="application/x-shockwave-flash"></embed>
    </div>
    <dov class="col-lg-12">
        <?= \cics\widgets\VideoEmbed::widget(['url' => 'http://www.youtube.com/watch?v=NMjA5N7kbEQ']); ?>
    </dov>
</div>



