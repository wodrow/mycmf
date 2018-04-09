<?php

namespace common\models\db\base;

use Yii;

/**
 * This is the model class for table "{{%test}}".
 *
 * @property string $id
 * @property string $name
 * @property string $image
 * @property string $images
 * @property string $video
 * @property string $videos
 * @property string $content
 * @property string $json
 * @property string $serialize
 */
class Test extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%test}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['images', 'videos', 'content', 'json', 'serialize'], 'string'],
            [['name'], 'string', 'max' => 50],
            [['image', 'video'], 'string', 'max' => 200],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'image' => Yii::t('app', 'Image'),
            'images' => Yii::t('app', 'Images'),
            'video' => Yii::t('app', 'Video'),
            'videos' => Yii::t('app', 'Videos'),
            'content' => Yii::t('app', 'Content'),
            'json' => Yii::t('app', 'Json'),
            'serialize' => Yii::t('app', 'Serialize'),
        ];
    }
}
