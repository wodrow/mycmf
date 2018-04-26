<?php
namespace common\widgets\wodrow\avatar;
/**
 * 设置挂件
 * @author 上班偷偷打酱油 （xianan_huang@163.com）
 * @copyright Yii中文网 （www.yii-china.com）
 */
use Yii;
use common\widgets\wodrow\avatar\assets\AvatarAsset;
use yii\base\Object;
use yii\bootstrap\Widget;

class AvatarWidget extends Widget
{    
    public $imageUrl = '';
    
    public function run()
    {
        $this->registerClientScript();       
        return $this->render('index',['imageUrl'=>$this->imageUrl]);
    }
    
    public function registerClientScript()
    {
        AvatarAsset::register($this->view);
    }
}