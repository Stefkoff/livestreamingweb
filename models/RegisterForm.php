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
use yii\helpers\Html;
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
            ['username', 'string', 'length' => [4, 30], 'tooShort' => 'Потребителското име трябва да е с дължина от 4 до 30 символа!', 'tooLong' => 'Потребителското име трябва да е с дължина от 4 до 30 символа!'],
            ['username', 'match', 'pattern' => '/^[a-zA-Z0-9_-]+$/', 'message' => 'Потребителското име може да садържа само: букви, цифри, "_" и "-"!'],
            [['username', 'email'], 'validateNewUser' ],
        ];
    }

    public function validateUsername($attr, $params){


        Yii::info(preg_match('/^[a-zA-Z\d]+$/', $this->$attr));

        if(preg_match('/^[a-zA-Z\d]+$/', $this->$attr) === false){
            $this->addError($attr, ucfirst($attr) . ' садържа непозволени символи');
        }
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

            $sendConfirmEmail = Setting::get('send_confirmation_email', 0);

            $newUser = new User();
            $newUser->username = $this->username;
            $newUser->email = $this->email;
            $now = new \DateTime();
            $newUser->creation_date = $now->format('Y-m-d H:i:s');
            $newUser->password = Yii::$app->security->generatePasswordHash($this->password);
            if($sendConfirmEmail == '0'){
                $newUser->is_confirmed = 1;
            } else{
                $newUser->is_confirmed = 0;
            }
            $newUser->setScenario(User::SCENARIO_SELF_REGISTER);
            if($newUser->save()){
                if($sendConfirmEmail == '1'){
                    Yii::$app->mailer->compose()
                        ->setFrom('stefkoff@gmail.com')
                        ->setTo($newUser->email)
                        ->setSubject('Потвърждаване на регистрация')
                        ->setHtmlBody("Моля, последвате " . Html::a('този', Yii::$app->urlManager->createAbsoluteUrl(['site/confirm', [
                                'authKey' => $newUser->authKey
                            ]])) . " линк, за да потвърдите вашата регистрация")
                        ->send();

                    Yii::$app->user->setFlash('success', 'Изпратихме Ви на посочения имейл линк за потвърждение на регистрацията!');
                }
                return true;
            }
        }

        return false;
    }
}