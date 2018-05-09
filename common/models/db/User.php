<?php

namespace common\models\db;

use common\components\budget\Smms;
use Yii;
use yii\db\Exception;

/**
 * This is the model class for table "{{%user}}".
 *
 * @property string $id
 * @property string $username
 * @property string $auth_key
 * @property string $password_hash
 * @property string $email
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 * @property string $token
 * @property string $key
 * @property string $tp_pwd
 *
 * @property AuthAssignment[] $authAssignments
 * @property AuthItem[] $itemNames
 */
class User extends \common\models\db\base\User
{
    const IS_SELLER_FALSE = 0;
    const IS_SELLER_TRUE = 1;
    const REAL_NAME_AUTH_STATUS_NOT_HAVE = 0;
    const REAL_NAME_AUTH_STATUS_DRAFT = 1;
    const REAL_NAME_AUTH_STATUS_SEND = 2;
    const REAL_NAME_AUTH_STATUS_FAILED = 3;
    const REAL_NAME_AUTH_STATUS_SUCCESS = 4;

    public function saveAvatar($url)
    {
        $trans = Yii::$app->db->beginTransaction();
        try{
            $file = new Files();
            $budget = Budget::findOne(['name'=>Smms::NAME]);
            $file->budget_id = $budget->id;
            $file->type = $file::TYPE_IMAGE;
            $_file = str_replace(Yii::getAlias('@wurl'), Yii::getAlias('@wroot'), $url);
            $data = $budget->operator->uploadLocalFile($_file);
            $file->width = $data['width'];
            $file->height = $data['height'];
            $file->filename = $data['filename'];
            $file->storename = $data['storename'];
            $file->size = $data['size'];
            $file->path = $data['path'];
            $file->hash = $data['hash'];
            $file->created_at = $data['timestamp'];
            $file->uploaded_ip = $data['ip'];
            $file->url = $data['url'];
            $file->delete_url = $data['delete'];
            $file->status = $file::STATUS_ACTIVE;
            $file->detail_data = json_encode($data);
            $file->func_for = $file::FUNC_FOR_AVATAR_CHANGE;
            $file->save(false);
            Yii::$app->user->identity->avatar = $file->id;
            Yii::$app->user->identity->save(false);
            $trans->commit();
            Yii::$app->session->addFlash('success', "头像修改成功");
        }catch (Exception $e){
            $trans->rollBack();
            throw $e;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::className(), ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::className(), ['name' => 'item_name'])->viaTable('{{%auth_assignment}}', ['user_id' => 'id']);
    }
}
