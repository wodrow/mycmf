<?php

namespace common\models\db;

use Yii;

/**
 * This is the model class for table "{{%test}}".
 *
 * @property integer $id
 * @property string $name
 * @property string $image
 * @property string $images
 * @property string $video
 * @property string $videos
 * @property string $content
 * @property string $json
 * @property string $serialize
 */
class Test extends \common\models\db\base\Test
{
    public function rules()
    {
        return [
            [['images', 'videos', 'content', 'json', 'serialize'], 'string'],
            [['image', 'video'], 'file'],
            [['time'], 'integer'],
            [['name', 'password'], 'string', 'max' => 50],
//            [['image', 'video'], 'string', 'max' => 200],
        ];
    }
}
