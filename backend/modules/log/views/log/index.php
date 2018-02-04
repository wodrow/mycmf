<?php

use yii\helpers\Html;
use kartik\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\modules\log\models\LogSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Logs');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="log-index">

    <h1><?php // echo Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'kartik\grid\SerialColumn'],

            'id',
            'level',
            'category',
            [
                'attribute'=>'log_time',
                'format' => ['date', 'php:Y-m-d H:i:s'],
                'filterType' => \kartik\grid\GridView::FILTER_DATE_RANGE,
                'filterWidgetOptions' =>[
                    'model'=>$searchModel,
                    'attribute'=>'log_time',
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
            'prefix:ntext',
            [
                'class' => \kartik\grid\DataColumn::className(),
                'attribute' => 'message',
//                'width'=>'10em',
//                'headerOptions' => ['width' => '100%'],
                'contentOptions' => ['style' => 'width:800px; white-space: normal;'],
//                'options' => ['style' => 'width:10em'],
            ],
//            'message:ntext',

            ['class' => 'kartik\grid\ActionColumn'],
        ],
    ]); ?>
</div>
