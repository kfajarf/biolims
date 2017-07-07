<?php


namespace app\models;

use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

class User extends ActiveRecord implements IdentityInterface
{
	

    public static function tableName()
    {
        return 'user';
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * Finds an identity by the given ID.
     *
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface|null the identity object that matches the given ID.
     */
    public static function findByUsername($username)
    {
        return static::findOne(['username' => $username]);
    }
	
	public function validatePassword($password) {
		return password_verify($password, $this->password_hash);
	}

    /**
     * Finds an identity by the given token.
     *
     * @param string $token the token to be looked for
     * @return IdentityInterface|null the identity object that matches the given token.
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return static::findOne(['auth_key' => $token]);
    }

    /**
     * @return int|string current user ID
     */
    public function getId()
    {
        return $this->id;
    }

    public function getStatus() {
        if (\Yii::$app->user->isGuest) throw new \yii\web\HttpException(403, 'You don\'t have permission to access this page.');
    }

    /**
     * @return string current user auth key
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @param string $authKey
     * @return boolean if auth key is valid for current user
     */
    public function validateAuthKey($auth_key)
    {
        return $this->getAuthKey() === $auth_key;
    }
	
	
	public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }
	
	public function getUser () {
		if ($this->isStaff()) return Staff::findOne(['id' => $this->id]);
	}
	
	public function isStaff() {
		if (isSet($this->id)) {
			if (Staff::findOne(['id' => $this->id])) return true;
		}
		return false;
	}
	
	public function notUpperManagement()
	{
		$staff = Staff::findOne(['user_id' => \Yii::$app->user->id]);
		if($staff)
			if(TopManagement::findOne(['staff_id' => $staff->id])) return false;
		return true;
	}
}