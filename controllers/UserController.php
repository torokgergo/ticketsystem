<?php

namespace app\controllers;

use app\models\User;
use yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class UserController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['profile', 'update', 'admins', 'list', 'admin-profile', 'delete'],
                'rules' => [
                    [
                        'actions' => ['profile', 'update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['admins', 'list', 'admin-profile', 'delete'],
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

    public function actionProfile()
    {
        $user = User::find()->where(['id' => Yii::$app->user->id])->one();
        return $this->render('profile', ['user' => $user]);
    }

    public function actionUpdate($id)
    {
        $user = User::find()->where(['id' => $id])->one();

        if ($user->load(Yii::$app->request->post())) {
            if ($user->save()) {
                Yii::$app->getSession()->setFlash('success', 'Az adatokat sikeresen frissítettem!');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Belső hiba történt!');
            }
            return $this->redirect('profile');
        }

        return $this->render('update', ['user' => $user]);
    }

    public function actionAdmins()
    {
        $query = User::find()->where(['role' => User::ROLE_ADMIN])->andWhere(['!=','id', Yii::$app->user->id]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'registration_date' => SORT_DESC,
                ]
            ]
        ]);

        return $this->render('admins', ['dataProvider' => $provider]);
    }

    public function actionList()
    {
        $query = User::find()->where(['role' => User::ROLE_USER]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'registration_date' => SORT_DESC,
                ]
            ]
        ]);

        return $this->render('list', ['dataProvider' => $provider]);
    }

    public function actionAdminProfile($id)
    {
        $user = User::find()->where(['id' => $id])->one();
        return $this->render('adminProfile', ['user' => $user]);
    }

    public function actionDelete($id)
    {
        $user = User::find()->where(['id' => $id])->one();
        if ($user->delete()) {
            Yii::$app->getSession()->setFlash('success', 'A felhasználót sikeresen töröltem!');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Belső hiba történt!');
        }
        return $this->redirect('list');
    }
}
