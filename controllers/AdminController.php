<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\filters\VerbFilter;
use app\models\User;
use yii\data\ActiveDataProvider;

class AdminController extends Controller
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

    public function actionUsers(){
        $query = User::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        return $this->render("users",["dataProvider"=>$dataProvider ]);
    }

    public function actionView($id) {
        $user = User::findOne(['id'=>$id]);
        return $this->render('view',['user'=>$user]);
    }

    public function actionUpdate($id){
        $user = User::findOne(['id'=>$id]);
        if($user -> load(Yii::$app->request->post())){
            if ($user->signUp()){
                Yii::$app->getSession()->setFlash('success', 'A felhasználót adatait sikeresen frissítettem!');
            }else{
                Yii::$app->getSession()->setFlash('error', 'Belső hiba történt!');
            }
            return $this->render("view", ["user"=>$user]);
        }
        return $this->render('update',['model'=>$user]);
    }

    public function actionDelete($id){
        $user = User::findOne(['id'=>$id]);
        if ($user->delete()){
            Yii::$app->getSession()->setFlash('success', 'A felhasználót sikeresen töröltem!');
        }else{
            Yii::$app->getSession()->setFlash('error', 'Belső hiba történt!');
        }
        return $this->redirect('users');
    }
}
