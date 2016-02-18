<?php

/**
 * Created by PhpStorm.
 * User: Georgi
 * Date: 2/15/2016
 * Time: 10:11 PM
 */

namespace app\models;

use yii\base\Model;
use Yii;
use yii\helpers\VarDumper;

class RegisterForm extends Model{
    public $username;
    public $password;
    public $email;
    public $repPass;

    public function rules()
    {
        return [
            // username and password are both required
            [['username', 'password', 'repPass', 'email'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            [['username', 'email'], 'validateNewUser' ],
        ];
    }

    public function validateNewUser($attr, $param){
        $user = User::findOne([
            $attr => $this->$attr
        ]);

        if($user){
            $this->addError($attr, 'Вече съществува потребител с ' . $attr .': ' . $this->$attr);
        }
    }

    public function attributeLabels()
    {
        return [
            'username' => 'Потребителско име',
            'password' => 'Парола',
            'repPass' => 'Потвърдете паролата',
            'email' => 'Email'
        ];
    }


    public function validatePassword($attr){
        if(!$this->hasErrors()){
            if(sha1($this->password . User::SALT) !== sha1($this->repPass . User::SALT)){
                $this->addError('password', 'The passwords must match!');
            }
        }
    }

    public function register(){
        if($this->validate()){
            $newUser = new User();
            $newUser->username = $this->username;
            $newUser->email = $this->email;
            $now = new \DateTime();
            $newUser->creation_date = $now->format('Y-m-d H:i:s');
            $newUser->password = Yii::$app->security->generatePasswordHash($this->password);
            $newUser->setScenario(User::SCENARIO_SELF_REGISTER);
            if($newUser->save()){
                return true;
            } else{
                Yii::info(VarDumper::dumpAsString($newUser->errors));
            }
        }

        return false;
    }
}