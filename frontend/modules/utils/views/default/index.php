<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-2
 * Time: 下午1:30
 */
$this->title = "工具列表";
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="utils-default-index">
    <div class="row">
        <div class="col-lg-12">
            <p>
                <?=\yii\helpers\Html::a('webshell', \common\config\Env::BACKEND_URL."/webshell", ['class' => "btn btn-primary", 'target' => "_blank"]) ?>
            </p>
        </div>
        <div class="col-lg-12">
            <p>
                <?=\yii\helpers\Html::a('在线工具(https://tool.lu/)', 'https://tool.lu/', ['class' => "btn btn-danger", 'target' => "_blank"]) ?>
                <?=\yii\helpers\Html::a('站长工具(http://tool.chinaz.com/)', 'http://tool.chinaz.com/', ['class' => "btn btn-danger", 'target' => "_blank"]) ?>
            </p>
        </div>
        <div class="col-lg-12">
            <p>
                <?=\yii\helpers\Html::a('反序列化', 'https://www.unserialize.com/', ['class' => "btn btn-info", 'target' => "_blank"]) ?>
                <?=\yii\helpers\Html::a('序列化/反序列化', 'http://www.gegecha.cn/serialize/', ['class' => "btn btn-info", 'target' => "_blank"]) ?>
            </p>
            <p>
                <?=\yii\helpers\Html::a('时间戳', 'http://tool.chinaz.com/Tools/unixtime.aspx', ['class' => "btn btn-warning", 'target' => "_blank"]) ?>
            </p>
        </div>
    </div>
</div>
