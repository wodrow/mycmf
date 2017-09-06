<?php

namespace common\models\test\tables;

use Yii;

/**
 * This is the model class for table "{{%tree}}".
 *
 * @property integer $id
 * @property integer $root
 * @property integer $lft
 * @property integer $rgt
 * @property integer $lvl
 * @property string $name
 * @property string $icon
 * @property integer $icon_type
 * @property integer $active
 * @property integer $selected
 * @property integer $disabled
 * @property integer $readonly
 * @property integer $visible
 * @property integer $collapsed
 * @property integer $movable_u
 * @property integer $movable_d
 * @property integer $movable_l
 * @property integer $movable_r
 * @property integer $removable
 * @property integer $removable_all
 */
class Tree extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%tree}}';
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
            [['root', 'lft', 'rgt', 'lvl', 'icon_type', 'active', 'selected', 'disabled', 'readonly', 'visible', 'collapsed', 'movable_u', 'movable_d', 'movable_l', 'movable_r', 'removable', 'removable_all'], 'integer'],
            [['lft', 'rgt', 'lvl', 'name'], 'required'],
            [['name'], 'string', 'max' => 60],
            [['icon'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'root' => Yii::t('app', 'Root'),
            'lft' => Yii::t('app', 'Lft'),
            'rgt' => Yii::t('app', 'Rgt'),
            'lvl' => Yii::t('app', 'Lvl'),
            'name' => Yii::t('app', 'Name'),
            'icon' => Yii::t('app', 'Icon'),
            'icon_type' => Yii::t('app', 'Icon Type'),
            'active' => Yii::t('app', 'Active'),
            'selected' => Yii::t('app', 'Selected'),
            'disabled' => Yii::t('app', 'Disabled'),
            'readonly' => Yii::t('app', 'Readonly'),
            'visible' => Yii::t('app', 'Visible'),
            'collapsed' => Yii::t('app', 'Collapsed'),
            'movable_u' => Yii::t('app', 'Movable U'),
            'movable_d' => Yii::t('app', 'Movable D'),
            'movable_l' => Yii::t('app', 'Movable L'),
            'movable_r' => Yii::t('app', 'Movable R'),
            'removable' => Yii::t('app', 'Removable'),
            'removable_all' => Yii::t('app', 'Removable All'),
        ];
    }
}
