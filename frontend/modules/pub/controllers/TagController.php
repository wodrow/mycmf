<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/12/17
 * Time: 9:35 AM
 */

namespace frontend\modules\pub\controllers;


use yii\web\Controller;

class TagController extends Controller
{
    public function actionTest()
    {
        $x = \Yii::getAlias('@wurl');
        var_export($x);
        $content = 'test 5';

        $filePath =
            \Yii::$app->uploads->saveContent(
            // upload group
                'useless-files',
                // upload file name
                'file.txt',
                // file content
                $content,
                \herroffizier\yii2um\UploadManager::STRATEGY_OVERWRITE
            );
    }
}