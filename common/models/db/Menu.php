<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-17
 * Time: 上午11:52
 */

namespace common\models\db;

use common\helpers\SysArrayHelper;
use Yii;

/**
 * Class Menu
 * @package common\models\db
 */
class Menu extends \common\models\db\base\Menu
{
    /**
     * 返回菜单列表
     * @param string $type 类别
     * @param bool $status 状态
     * @return array
     */
    public static function getMenusForB1($type, $status = false)
    {
        $models = Menu::find()
//            ->where(['type'=>$type])
//            ->andFilterWhere(['status' => $status])
//            ->orderBy('sort asc')
            ->asArray()
            ->all();

        $id = Yii::$app->user->id;

        /*// 判断是否是管理员
        if($id != Yii::$app->params['adminAccount'] && Yii::$app->config->info('SYS_MENU_SHOW_TYPE') == 1)
        {
            // 查询用户权限
            $authAssignment = SysAuthAssignment::find()
                ->with('itemNameChild')
                ->where(['user_id' => $id])
                ->asArray()
                ->one();

            // 匹配菜单
            if(isset($authAssignment['itemNameChild']))
            {
                $menu = [];
                foreach ($models as $model)
                {
                    foreach ($authAssignment['itemNameChild'] as $item)
                    {
                        if($model['url'] == $item['child'])
                        {
                            $menu[] = $model;
                        }
                    }
                }

                // 数组排序
                $models = SysArrayHelper::arraySort($menu,'sort');
            }
        }*/

        return SysArrayHelper::itemsMerge($models,'id', 0, 'parent');
    }
}