<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-16
 * Time: 上午10:51
 */

namespace common\models\db;


use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;

class Files extends \common\models\db\base\Files
{
    const TYPE_OTHER = 1;
    const TYPE_IMAGE = 2;
    const TYPE_WORD = 3;
    const TYPE_TXT = 4;
    const TYPE_VIDEO = 5;
    const FUNC_FOR_AVATAR_CHANGE = 'avatar-change';
    const STATUS_ACTIVE = 10;

    public function behaviors()
    {
        return [
            'blameable' => [
                'class' => BlameableBehavior::className(),
            ],
            'timestamp' => [
                'class' => TimestampBehavior::className(),
            ],
        ];
    }
}