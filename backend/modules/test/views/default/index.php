<?php
/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 */
?>

<div class="test-default-index">
    <?php
    \leandrogehlen\treegrid\TreeGrid::widget([
        'dataProvider' => $dataProvider,
        'keyColumnName' => 'id',
        'parentColumnName' => 'pid',
        'parentRootValue' => '1', //first parentId value
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
