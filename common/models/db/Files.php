<?php
/**
 * Created by PhpStorm.
 * User: wodrow
 * Date: 18-4-16
 * Time: 上午10:51
 */

namespace common\models\db;


use common\components\budget\ApiResp;
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
    const FUNC_FOR_REAL_NAME_CHECK = 'real-name-check';
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

    public function rules()
    {
        return [
            [['type', 'url', 'delete_url', 'filename'], 'required'],
            [['type', 'created_at', 'updated_at', 'created_by', 'updated_by', 'uploaded_at', 'size', 'width', 'height', 'budget_id', 'status'], 'integer'],
            [['url', 'delete_url', 'filename', 'path', 'storename', 'hash'], 'string', 'max' => 200],
            [['uploaded_ip'], 'string', 'max' => 30],
            [['func_for'], 'string', 'max' => 20],
            [['budget_id'], 'exist', 'skipOnError' => true, 'targetClass' => Budget::className(), 'targetAttribute' => ['budget_id' => 'id']],
            [['created_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['created_by' => 'id']],
            [['updated_by'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['updated_by' => 'id']],
        ];
    }

    /**
     * @param ApiResp $data
     */
    public function initDataByBudgetResp($data)
    {
        foreach ($data as $k => $v) {
            $this->$k = $v;
        }
        /*$this->width = $data->width;
        $this->height = $data->height;
        $this->filename = $data->filename;
        $this->storename = $data->storename;
        $this->size = $data->size;
        $this->path = $data->path;
        $this->hash = $data->hash;
        $this->created_at = $data->uploaded_at;
        $this->uploaded_ip = $data->uploaded_ip;
        $this->url = $data->url;
        $this->delete_url = $data->delete_url;*/
    }
}