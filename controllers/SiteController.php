<?php

namespace app\controllers;

use app\models\RegisterForm;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
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
                $this->redirect('/');
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

        Yii::info('email: ' . $email);

        if($request->isPost){
            if($email){
                $userModel = User::findOne(['email' => $email]);

                /**
                 * @var $userModel User
                 */

                Yii::info($userModel);

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
                    $success = true;
                } else{
                    $error = 'Няма съществуващ потребител с имейл: ' . $email;
                }
            } else{
                $error = 'Моля, въведете имейл адрес!';
            }
        }

        Yii::info($error);

        return $this->render('forgot', [
            'success' => $success,
            'error' => $error
        ]);
    }
}
