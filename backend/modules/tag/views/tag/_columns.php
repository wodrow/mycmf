<?php
/**
 * @var \backend\modules\tag\models\TagSearch $searchModel
 */
use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
        // [
        // 'class'=>'\kartik\grid\DataColumn',
        // 'attribute'=>'id',
    // ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'attribute'=>'title',
    ],
    [
        'attribute'=>'created_at',
        'format' => ['date', 'php:Y-m-d'],
        'filterType' => \kartik\grid\GridView::FILTER_DATE_RANGE,
        'filterWidgetOptions' =>[
            'model'=>$searchModel,
            'attribute'=>'created_at',
//                    'presetDropdown'=>TRUE,
            'convertFormat'=>true,
            'pluginOptions'=>[
                'format'=>'Y-m-d',
                'opens'=>'left',
                'locale' => [
                    'cancelLabel' => 'Clear',
                    'format' => 'Y-m-d',
                ],
            ]
        ],
    ],
    [
        'attribute'=>'updated_at',
        'format' => ['date', 'php:Y-m-d'],
        'filterType' => \kartik\grid\GridView::FILTER_DATE_RANGE,
        'filterWidgetOptions' =>[
            'model'=>$searchModel,
            'attribute'=>'updated_at',
//                    'presetDropdown'=>TRUE,
            'convertFormat'=>true,
            'pluginOptions'=>[
                'format'=>'Y-m-d',
                'opens'=>'left',
                'locale' => [
                    'cancelLabel' => 'Clear',
                    'format' => 'Y-m-d',
                ],
            ]
        ],
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => '创建者',
        'attribute'=>'created_by',
        'value' => function ($model) {
            return $model->createdBy->username;
        },
    ],
    [
        'class'=>'\kartik\grid\DataColumn',
        'label' => '修改者',
        'attribute'=>'updated_by',
        'value' => function ($model) {
            return $model->updatedBy->username;
        },
    ],
//    [
//        'label' => '创建者',
//        'filter' => \yii\helpers\Html::activeTextInput($searchModel, 'created_by', ['class' => 'form-control']),
//        'format' => 'raw',
//        'value' => function ($model) {
//            return $model->createdBy->username;
//        },
//    ],
    [
        'class' => \common\components\grid\KEnumColumn::class,
        'attribute' => 'status',
        'enum' => \common\models\Enum::getStatus(),
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'vAlign'=>'middle',
        'urlCreator' => function($action, $model, $key, $index) { 
                return Url::to([$action,'id'=>$key]);
        },
        'viewOptions'=>['role'=>'modal-remote','title'=>'View','data-toggle'=>'tooltip'],
        'updateOptions'=>['role'=>'modal-remote','title'=>'Update', 'data-toggle'=>'tooltip'],
        'deleteOptions'=>['role'=>'modal-remote','title'=>'Delete', 
                          'data-confirm'=>false, 'data-method'=>false,// for overide yii data api
                          'data-request-method'=>'post',
                          'data-toggle'=>'tooltip',
                          'data-confirm-title'=>'Are you sure?',
                          'data-confirm-message'=>'Are you sure want to delete this item'], 
    ],

];   