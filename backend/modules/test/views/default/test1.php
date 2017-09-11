<?php
/**
 * @var \yii\web\View $this
 * @var \yii\data\ActiveDataProvider $dataProvider
 */
?>

<div class="test-default-test1">
    <?php
    echo \leandrogehlen\treegrid\TreeGrid::widget([
        'dataProvider' => $dataProvider,
        'keyColumnName' => 'id',
        'parentColumnName' => 'pid',
        'parentRootValue' => '0', //first parentId value
        'pluginOptions' => [
            'initialState' => 'collapsed',
        ],
        'columns' => [
            'name',
            'id',
            'pid',
            ['class' => 'yii\grid\ActionColumn']
        ]
    ]);
    ?>
</div>
