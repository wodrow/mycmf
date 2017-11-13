<?php

namespace frontend\modules\test\models;

use Yii;

/**
 * This is the model class for table "{{%test1_files}}".
 *
 * @property integer $id
 * @property integer $test1_id
 * @property string $file_url
 *
 * @property Test1 $test1
 */
class Test1Files extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%test1_files}}';
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
            [['id', 'test1_id'], 'required'],
            [['id', 'test1_id'], 'integer'],
            [['file_url'], 'string', 'max' => 255],
            [['test1_id'], 'exist', 'skipOnError' => true, 'targetClass' => Test1::className(), 'targetAttribute' => ['test1_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'test1_id' => Yii::t('app', 'Test1 ID'),
            'file_url' => Yii::t('app', 'File Url'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTest1()
    {
        return $this->hasOne(Test1::className(), ['id' => 'test1_id']);
    }
}
