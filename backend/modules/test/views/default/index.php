<?php
/**
 * @var \yii\data\ActiveDataProvider $dataProvider
 */
?>

<div class="test-default-index">
    <?php
    \kartik\tree\TreeView::widget([
        'query'             => \common\models\test\Tree::find()->addOrderBy('root, lft'),
        'headingOptions' => ['label' => 'Categories'],
        'rootOptions' => ['label'=>'<span class="text-primary">Root</span>'],
        'fontAwesome' => true,
        'isAdmin' => true,
        'displayValue' => 1,
        'iconEditSettings'=> [
            'show' => 'list',
            'listData' => [
                'folder' => 'Folder',
                'file' => 'File',
                'mobile' => 'Phone',
                'bell' => 'Bell',
            ],
        ],
        'softDelete' => true,
        'cacheSettings' => ['enableCache' => true],
        'nodeLabel' => [
            1 => 'Phones Custom', // original name is Phones
            2 => 'Laptops Custom', // original name is Laptops
        ]
//        'nodeView' => '@kvtree/views/_form',
//        'nodeActions' => [
//            \kartik\tree\Module::NODE_MANAGE => \yii\helpers\Url::to(['/treemanager/node/manage']),
//            \kartik\tree\Module::NODE_SAVE => \yii\helpers\Url::to(['/treemanager/node/save']),
//            \kartik\tree\Module::NODE_REMOVE => \yii\helpers\Url::to(['/treemanager/node/remove']),
//            \kartik\tree\Module::NODE_MOVE => \yii\helpers\Url::to(['/treemanager/node/move']),
//        ],
//        'nodeAddlViews' => [
//            \kartik\tree\Module::VIEW_PART_1 => '',
//            \kartik\tree\Module::VIEW_PART_2 => '',
//            \kartik\tree\Module::VIEW_PART_3 => '',
//            \kartik\tree\Module::VIEW_PART_4 => '',
//            \kartik\tree\Module::VIEW_PART_5 => '',
//        ],
    ]);
    ?>
</div>
