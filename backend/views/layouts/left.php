<?php
$items = [
    ['label' => Yii::t('app', 'Operate Menus'), 'options' => ['class' => 'header']],
    ['label' => 'Meter', 'icon'=>'dashboard', 'url' => ['/site'],],
];

$menus = \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id,null,function($menu){
    $data = json_decode($menu['data'], true);
    $items = $menu['children'];
    $return = [
        'label' => $menu['name'],
        'url' => [$menu['route']],
    ];
    //处理我们的配置
    if ($data) {
        //visible
        isset($data['visible']) && $return['visible'] = $data['visible'];
        //icon
        isset($data['icon']) && $data['icon'] && $return['icon'] = $data['icon'];
        //other attribute e.g. class...
        $return['options'] = $data;
    }
    //没配置图标的显示默认图标
    (!isset($return['icon']) || !$return['icon']) && $return['icon'] = 'fa fa-circle-o';
    $items && $return['items'] = $items;
    return $return;
});
//$menus = \mdm\admin\components\MenuHelper::getAssignedMenu(Yii::$app->user->id);

$items = array_merge($items,$menus);
?>

<aside class="main-sidebar">
    <section class="sidebar">

        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="http://7xsbq6.com1.z0.glb.clouddn.com/QQ%E6%88%AA%E5%9B%BE20170824155816.png" class="img-circle" alt="User Image"/>
            </div>
            <div class="pull-left info">
                <p><?=Yii::$app->user->identity->username ?></p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>

        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
            </div>
        </form>
        <!-- /.search form -->
        ?>

        <?php
        echo \yii\widgets\Menu::widget([
            'options' => ['class' => 'sidebar-menu'],
            'items' => $items,
        ]);
        ?>

    </section>

</aside>
