<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 17-10-30
 * Time: 上午9:26
 */

namespace frontend\modules\test\models;


use common\components\behaviors\IpBehavior;
use common\components\behaviors\UUIDBehavior;
use Yii;

/**
 * This is the model class for table "test_test1".
 *
 * @property integer $id
 * @property string $uuid
 * @property string $created_ip
 * @property string $updated_ip
 * @property string $text
 * @property string $json
 * @property string $attachment
 *
 * @property Test1Files[] $test1_files
 */
class Test1 extends \yii\db\ActiveRecord
{
    public function behaviors()
    {
        return [
            'uuid' => [
                'class' => UUIDBehavior::className(),
                'column' => 'uuid',
            ],
            'ip' => [
                'class' => IpBehavior::className(),
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%test1}}';
    }

    /**
     * @return \yii\db\Connection the database connection used by this AR class.
     */
    public static function getDb()
    {
        return Yii::$app->get('db_test');
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['text'], 'required'],
            [['uuid', 'created_ip', 'updated_ip', 'text', 'json'], 'string', 'max' => 50],
//            ['attachment', 'string', 'max' => 255],
            ['attachment', 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'uuid' => Yii::t('app', 'Uuid'),
            'created_ip' => Yii::t('app', 'Created Ip'),
            'updated_ip' => Yii::t('app', 'Updated Ip'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest1Files()
    {
        return $this->hasMany(Test1Files::className(), ['id' => 'test1_id']);
    }
}