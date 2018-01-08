<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-1-8
 * Time: 下午1:28
 */
$this->beginContent('@frontend/views/layouts/base.php');
?>
<div class="container">
    <div class="row">
        <div class="col-lg-3 col-md-3 col-sm-4">
            <?= leoshtika\bootstrap\NavSidebar::widget([
                'items' => [
                    [
                        'url' => ['site/index'],
                        'label' => 'Home',
                        'icon' => 'home' // This is a bootstrap icon name
                    ],
                    [
                        'url' => ['site/about'],
                        'label' => 'about',
                        'icon' => 'info-sign' // This is a bootstrap icon name
                    ],
                ],
            ]) ?>
        </div>
        <div class="col-lg-9 col-md-9 col-sm-8">
            <?= \yii\widgets\Breadcrumbs::widget([
                'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                'encodeLabels' => false,
            ]) ?>
            <?= \common\widgets\Alert::widget() ?>
            <?= $content ?>
        </div>
    </div>
</div>
<?php $this->endContent() ?>
