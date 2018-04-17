<?php
$this->title = '首页';
$this->params['breadcrumbs'][] = ['label' =>  $this->title];
?>

<div class="wrapper wrapper-content">
    <div class="row">
        <div class="col-sm-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h4>后台用户</h4>
                    <h1 class="no-margins"><?= 3?></h1>
                    <div class="stat-percent font-bold text-navy">位</div>
                    <small>总人数</small>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h4>日志行为</h4>
                    <h1 class="no-margins"><?= 5?></h1>
                    <div class="stat-percent font-bold text-navy">条</div>
                    <small>总记录</small>
                </div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="ibox">
                <div class="ibox-content">
                    <h4>后台访问量</h4>
                    <h1 class="no-margins"><?= 2?></h1>
                    <div class="stat-percent font-bold text-navy">次</div>
                    <small>总访问量</small>
                </div>
            </div>
        </div>
    </div>
</div>

