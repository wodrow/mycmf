<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-16
 * Time: 上午10:51
 */

namespace common\models\db;


class Files extends \common\models\db\base\Files
{
    const TYPE_OTHER = 1;
    const TYPE_IMAGE = 2;
    const TYPE_WORD = 3;
    const TYPE_TXT = 4;
    const TYPE_VIDEO = 5;
}