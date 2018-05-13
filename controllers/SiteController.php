<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\User;

class SiteController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['login', 'logout', 'registration', 'create-admin'],
                'rules' => [
                    [
                        'actions' => ['login', 'registration'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['create-admin'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($role, $action) {
                            return User::isUserAdmin(Yii::$app->user->identity->email);
                        }
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
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $LoginForm = new LoginForm();
        if ($LoginForm->load(Yii::$app->request->post()) && $LoginForm->login()) {
            return $this->goBack();
        }

        return $this->render('login', [
            'model' => $LoginForm,
        ]);
    }

    public function actionLogout()
    {
        if (Yii::$app->user->logout()) {
            Yii::$app->getSession()->setFlash('success', 'Sikeres kilépés!');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Belső hiba történt!');
        }
        return $this->goHome();
    }

    public function actionRegistration()
    {
        $user = new User();
        if ($user->load(Yii::$app->request->post())) {
            $user->password = Yii::$app->getSecurity()->generatePasswordHash($user->password);
            if ($user->save()) {
                Yii::$app->getSession()->setFlash('success', 'Sikeres regisztráció!');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Belső hiba történt!');
            }
            return $this->goHome();
        }
        return $this->render('registration', ['user' => $user]);
    }

    public function actionCreateAdmin()
    {
        $admin = new User();
        if ($admin->load(Yii::$app->request->post())) {
            $admin->password = Yii::$app->getSecurity()->generatePasswordHash($admin->password);
            $admin->role = User::ROLE_ADMIN;
            if ($admin->save()) {
                Yii::$app->getSession()->setFlash('success', 'Az admint sikeresen létrehoztam!');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Belső hiba történt!');
            }
            return $this->goHome();
        }
        return $this->render('create_admin', ['user' => $admin]);
    }
}
