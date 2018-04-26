<?php
namespace common\widgets\wodrow\avatar;
/**
 * @see Yii中文网  http://www.yii-china.com
 * @author Xianan Huang <Xianan_huang@163.com>
 * 头像上传组件
 * 如何配置请到官网（Yii中文网：www.yii-china.com）查看相关文章
 */
use Yii;
use yii\base\Action;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
use common\widgets\wodrow\avatar\CropAvatar;

class CropAction extends Action
{
    public $config = [];

    public $baseUrl;
    public $basePath;
    
    public function init()
    {
        $config = [
            'bigImageWidth' => '200',   //大图默认宽度
            'bigImageHeight' => '200',  //大图默认高度
            'middleImageWidth'=> '100', //中图默认宽度
            'middleImageHeight'=> '100',//中图图默认高度
            'smallImageWidth' => '50',  //小图默认宽度
            'smallImageHeight' => '50', //小图默认高度
            //头像上传目录
            'uploadPath' => 'uploads/avatar',  
        ];
        $this->basePath = Yii::getAlias($this->basePath);//获取实际磁盘
        $this->baseUrl = Yii::getAlias($this->baseUrl); //获取访问路径
        $this->config = ArrayHelper::merge($config, $this->config);
        parent::init();
    }
    
    public function run()
    {
         $crop = new CropAvatar(
                
                isset($_POST['avatar_src']) ? $_POST['avatar_src'] : null,
                isset($_POST['avatar_data']) ? $_POST['avatar_data'] : null,
                isset($_FILES['avatar_file']) ? $_FILES['avatar_file'] : null,
                $this->basePath
            );
        $response = array(
          'state'  => 200,
          'message' => $crop -> getMsg(),
          'result' => $this->baseUrl.'/'.$crop -> getResult()
        );

        echo json_encode($response);die;
        
    }
}