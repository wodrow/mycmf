<?php

namespace common\models\db;

use common\components\budget\Smms;
use Yii;
use yii\base\ErrorException;
use yii\db\Exception;
use yii\httpclient\Client;

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
 * @property Files $avatarFile
 * @property UserRealNameAuth $userRealNameAuth
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
            $file->status = $file::STATUS_ACTIVE;
            $file->func_for = $file::FUNC_FOR_AVATAR_CHANGE;
            $_file = str_replace(Yii::getAlias('@wurl'), Yii::getAlias('@wroot'), $url);
            $data = $budget->operator->uploadLocalFile($_file);
            $file->initDataByBudgetResp($data);
            $file->save(false);
            if (Yii::$app->user->identity->avatar){
                $delete_url = Yii::$app->user->identity->avatarFile->delete_url;
                if (Yii::$app->user->identity->avatarFile->delete()){
                    $budget->operator->deleteByUrl($delete_url);
                }else{
                    throw new ErrorException("老头像删除失败");
                }
            }
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
     * @return string
     */
    public function getAvatarUrl()
    {
        return $this->avatarFile->url;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthAssignments()
    {
        return $this->hasMany(AuthAssignment::class, ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItemNames()
    {
        return $this->hasMany(AuthItem::class, ['name' => 'item_name'])->viaTable('{{%auth_assignment}}', ['user_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAvatarFile()
    {
        return $this->hasOne(Files::class, ['id' => 'avatar']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserRealNameAuth()
    {
        return $this->hasOne(UserRealNameAuth::class, ['user_id' => 'id']);
    }
}
