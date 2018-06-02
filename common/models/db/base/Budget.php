<?php

namespace common\models\db\base;

use common\components\budget\Api;
use common\components\budget\Smms;
use Yii;
use yii\base\ErrorException;

/**
 * This is the model class for table "{{%budget}}".
 *
 * @property string $id
 * @property string $name
 * @property string $title
 * @property int $status
 *
 * @property Api $opt
 * @property Files[] $files
 */
class Budget extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%budget}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['status'], 'integer'],
            [['name', 'title'], 'string', 'max' => 50],
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
            'title' => Yii::t('app', 'Title'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    /**
     * @return Api
     * @throws ErrorException
     */
    public function getOpt()
    {
        switch ($this->name){
            case Smms::NAME:
                $opt = new Smms();
                break;
            default:
                throw new ErrorException('没有找到图床实例');
                break;
        }
        return $opt;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFiles()
    {
        return $this->hasMany(Files::class, ['budget_id' => 'id']);
    }
}
