<?php

namespace app\controllers;

use app\models\RegisterForm;
use Yii;
use yii\filters\AccessControl;
use app\filters\AccessRules;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\components\BaseController;
use app\models\Setting;

class SiteController extends BaseController
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'ruleConfig' => [
                    'class' => AccessRules::className()
                ],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin()
    {
        if (!\Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAbout()
    {
        return $this->render('about');
    }

    public function actionRegister(){
        $form = new RegisterForm();
        if($form->load(Yii::$app->request->post()) && $form->validate()){
            if($form->register()){
                if(Setting::get('send_confirmation_email', 0) == 0) {
                    Yii::$app->user->setFlash('success', '<strong>Поздравления</strong>! Успешно се регистрирахте в сайта!');
                }
            }
        }

        return $this->render('register', [
            'form' => $form
        ]);

    }

    public function actionForgot(){
        $request = Yii::$app->request;

        $email = $request->post('email', false);

        $success = false;
        $error = '';

        if($request->isPost){
            if($email){
                $userModel = User::findOne(['email' => $email]);

                /**
                 * @var $userModel User
                 */

                if($userModel){
                    $userModel->accessToken = Yii::$app->security->generateRandomString();
                    $userModel->save();

                    Yii::$app->mailer->compose()
                        ->setFrom('admin@liveevents.com')
                        ->setTo($email)
                        ->setHtmlBody("<p>Натиснете <a href='" . Yii::$app->urlManager->createAbsoluteUrl([
                                'site/renewpass', 'token' => $userModel->accessToken
                            ]) ."'>тук</a> за да възтановите паролат си!</p>")
                        ->send();
                    Yii::$app->session->setFlash('success', 'Изпратихме Ви линк на посоченият имейл, за да последвате процедурата по възобновяване на паролата');
                } else{
                    Yii::$app->session->setFlash('error', 'Няма съществуващ потребител с имейл: <strong>' . $email . '</strong>');
                }
            } else{
                Yii::$app->user->setFlash('error', 'Моля, въведете имейл адрес!');
            }
        }

        return $this->render('forgot', [
            'success' => $success,
            'error' => $error
        ]);
    }

    public function actionRenewpass(){
        $request = Yii::$app->request;
        $accessToken = false;

        if($request->isGet){
            $accessToken = $request->get('token', false);
        } else if($request->isPost){
            $accessToken = $request->post('token', false);
        }

        if($accessToken){
            $user = User::findIdentityByAccessToken($accessToken);

            if($user){
                $submit = $request->post('submit', false);

                if($submit){
                    $newPass = $request->post('new_pass', false);
                    $rePass = $request->post('re_pass', false);

                    if(!$newPass || !$rePass){
                        Yii::$app->session->setFlash('error', 'Моля, попълнете всички полета!');
                    } else{
                        if($newPass !== $rePass){
                            Yii::$app->session->setFlash('error', 'Паролите не съвпадат!');
                        } else{
                            $userModel = User::findOne($user->getId());

                            /**
                             * @var $userModel User
                             */

                            $userModel->password = Yii::$app->security->generatePasswordHash($newPass);
                            $userModel->accessToken = null;
                            $userModel->save();
                            Yii::$app->session->setFlash('success', 'Вашата парола беше сменена <strong>успехно!</strong> Сега вече можете да влезете в системата!');
                        }
                    }
                }

                return $this->render('renew_pass', [
                    'accessToken' => $accessToken
                ]);

            } else{
                $this->redirect('/');
            }
        } else{
            $this->redirect('/');
        }
    }

    public function actionMaintenance(){
        $this->layout = false;
        return $this->render('maintenance');
    }

    public function actionConfirm(){
        $request = Yii::$app->request;

        $authKey = $request->get('authKey', false);

        if($authKey){
            $userModel = User::findOne([
                'authKey' => $authKey
            ]);

            /**
             * @var $userModel User
             */

            if($userModel->is_confirmed == 0){
                if($userModel){
                    $userModel->is_confirmed = 1;
                    if($userModel->save()){
                        Yii::$app->user->login($userModel);
                    }
                }
            }
        }

        $this->redirect('/');
    }

    public function actionAjax(){
        if(Yii::$app->request->isAjax){

            $result = [
                'isGuest' => true
            ];

            if(!Yii::$app->user->isGuest){
                $userModel = User::findOne(Yii::$app->user->id);

                /**
                 * @var $userModel User
                 */

                if($userModel){
                    $result['isGuest'] = false;
                    $result = array_merge($result, $userModel->encodeData());
                }
            }

            $result = array_merge($result, Setting::getAll());

            $this->sendJson($result);
        }
    }
}
