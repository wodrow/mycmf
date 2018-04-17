<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-17
 * Time: 下午3:00
 */

namespace backend\widgets\wodrow\input;


use kartik\widgets\InputWidget;

class Image extends InputWidget
{
    public function run()
    {
        return $this->render('image', [
            'model' => $this->model,
        ]);
    }
}