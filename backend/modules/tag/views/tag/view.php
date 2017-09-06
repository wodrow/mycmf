<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\modules\tag\models\Tag */
?>
<div class="tag-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'title',
            'status',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
