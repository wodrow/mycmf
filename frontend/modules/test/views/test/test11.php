<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-2-4
 * Time: 下午5:30
 * @var \yii\web\View $this
 */
$this->title = "分色";
$x = shell_exec("ls -al");
?>

<div class="test-test-test11">
    <div class="row">
        <div class="col-log-12">
            <?=$x ?>
        </div>
    </div>
</div>
