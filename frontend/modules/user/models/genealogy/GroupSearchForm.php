<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 9/14/17
 * Time: 2:33 PM
 */

namespace frontend\modules\user\models\genealogy;


use common\models\Enum;
use yii\base\Model;

class GroupSearchForm extends Model
{
    public $mark;
    public $title;
    public $info;

    public function attributeLabels()
    {
        return [
            'mark' => "标示",
            'title' => "名称",
            'info' => "模糊信息",
        ];
    }

    public function rules()
    {
        return [
            [['mark', 'title', 'info'], 'safe'],
        ];
    }

    public function search()
    {
        $query = Group::find()->orderBy(['created_at'=>SORT_DESC]);
        $query->andFilterWhere(['status'=>Enum::STATUS_ACTIVE])
            ->andFilterWhere(['mark'=>$this->mark])
            ->andFilterWhere(['title'=>$this->title])
            ->andFilterWhere(['like', 'info', $this->info]);
        return $query;
    }
}