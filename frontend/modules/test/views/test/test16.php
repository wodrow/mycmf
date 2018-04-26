<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use frontend\widgets\wodrow\avatar\AvatarWidget;

//$this->title = 'test';
?>

<div class="frontend-test-test-test16">
    <div class="row">
        <div class="col-lg-12">
            <?= AvatarWidget::widget([
                'avatar_url' => $model->image,
            ]) ?>
        </div>
    </div>
</div>