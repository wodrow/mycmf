<?php
/**
 * @link http://www.iisns.com/
 * @copyright Copyright (c) 2015 iiSNS
 * @license http://www.iisns.com/license/
 */

namespace common\widgets\iisns\webuploader;

use yii\web\AssetBundle;

/**
 * @author Shiyang <dr@shiyang.me>
 */
class MultiImageAsset extends AssetBundle
{
	public $css = [
	  	'webuploader.css',
		'multi.css',
	];

	public $js = [
		'dist/webuploader.min.js',
		'multi.upload.js',
	];

	public $depends = [
		'yii\web\JqueryAsset'
	];

    public function init()
    {
        $this->sourcePath = __DIR__.DIRECTORY_SEPARATOR."assets";
        parent::init();
    }
}
