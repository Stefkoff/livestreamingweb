<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "user".
 *
 * @property string $id
 * @property string $username
 * @property string $password
 * @property string $email
 * @property string $authKey
 * @property string $accessToken
 * @property string $creation_date
 * @property string $last_login_date
 * @property string $last_login_ip
 * @property integer $is_confirmed
 *
 * @property GroupMember[] $groupMembers
 */
class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{

    const SALT = 'fwergwegqwegqeg';
    const SCENARIO_SELF_REGISTER = 'selfRegister';
    const SCENARIO_UPDATE = 'update';
    const SCENARIO_INSERT = 'insert';
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email'], 'required', 'on' => [self::SCENARIO_DEFAULT, self::SCENARIO_SELF_REGISTER]],
            ['password', 'required', 'except' => 'updatePassword'],
            [['creation_date', 'last_login_date'], 'safe'],
            [['is_confirmed'], 'integer'],
            [['username', 'email'], 'string', 'max' => 45],
            [['password', 'authKey', 'accessToken'], 'string', 'max' => 255],
            [['last_login_ip'], 'string', 'max' => 25],
            [['username', 'email'], 'unique', 'on' => [self::SCENARIO_INSERT, self::SCENARIO_SELF_REGISTER] ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'authKey' => 'Auth Key',
            'accessToken' => 'Access Token',
            'creation_date' => 'Creation Date',
            'last_login_date' => 'Last Login Date',
            'last_login_ip' => 'Last Login Ip',
            'is_confirmed' => 'Is Confirmed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGroupMembers()
    {
        return $this->hasMany(GroupMember::className(), ['id_user' => 'id']);
    }

    public function beforeSave($insert)
    {
        if(parent::beforeSave($insert)){
            if($this->isNewRecord){
                $this->authKey = Yii::$app->security->generateRandomString();
                $this->creation_date = Yii::$app->time->getUTCNow();
            } else{
                if($this->getScenario() === 'updatePassword'){
                    $this->password = Yii::$app->security->generatePasswordHash($this->password);
                }
            }
            return true;
        }

        return false;
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($insert){
            if($this->getScenario() === self::SCENARIO_SELF_REGISTER){
                $usersGroup = Group::findOne([
                    'name' => Group::GROUP_USER
                ]);

                /**
                 * @var $usersGroup Group
                 */

                if($usersGroup){
                    $groupMember = new GroupMember();
                    $groupMember->id_group = $usersGroup->id;
                    $groupMember->id_user = $this->id;
                    $groupMember->save();
                }
            }
        }
    }

    public static function findByUsername($username){
        return self::findOne(['username' => $username]);
    }

    public function validatePassword($password){
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    /**
     * Finds an identity by the given ID.
     * @param string|integer $id the ID to be looked for
     * @return IdentityInterface the identity object that matches the given ID.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentity($id)
    {
        $user = self::findOne($id);

        return $user;
    }

    /**
     * Finds an identity by the given token.
     * @param mixed $token the token to be looked for
     * @param mixed $type the type of the token. The value of this parameter depends on the implementation.
     * For example, [[\yii\filters\auth\HttpBearerAuth]] will set this parameter to be `yii\filters\auth\HttpBearerAuth`.
     * @return IdentityInterface the identity object that matches the given token.
     * Null should be returned if such an identity cannot be found
     * or the identity is not in an active state (disabled, deleted, etc.)
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['accessToken' => $token]);
    }

    /**
     * Returns an ID that can uniquely identify a user identity.
     * @return string|integer an ID that uniquely identifies a user identity.
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Returns a key that can be used to check the validity of a given identity ID.
     *
     * The key should be unique for each individual user, and should be persistent
     * so that it can be used to check the validity of the user identity.
     *
     * The space of such keys should be big enough to defeat potential identity attacks.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @return string a key that is used to check the validity of a given identity ID.
     * @see validateAuthKey()
     */
    public function getAuthKey()
    {
        return $this->authKey;
    }

    /**
     * Validates the given auth key.
     *
     * This is required if [[User::enableAutoLogin]] is enabled.
     * @param string $authKey the given auth key
     * @return boolean whether the given auth key is valid.
     * @see getAuthKey()
     */
    public function validateAuthKey($authKey)
    {
        return true;
    }

    public function encodeData(){
        $result = [];

        foreach($this->getAttributes() as $key => $value){
            $result[$key] = $value;
        }

        return $result;
    }
}
