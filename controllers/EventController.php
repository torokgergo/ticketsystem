<?php

namespace app\controllers;

use app\models\Event;
use app\models\EventApply;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use Yii;
use app\models\User;

class EventController extends \yii\web\Controller
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

    public function actionEvents(){
        $query = Event::find();
        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10,
            ]
        ]);
        return $this->render("events",["dataProvider"=>$dataProvider ]);
    }

    public function actionSign($id){
        $eventApply = new EventApply();
        $user = User::find()->where(['email' => Yii::$app->user->identity->email])->one();
        $eventApply->user_id = $user->id;
        $eventApply->event_id = $id;
        $eventApply->save();
        return $this->actionEvents();
    }




    public function actionCreate(){
        $event = new Event();
        if($event -> load(Yii::$app->request->post())){
            if($event->save()){
                Yii::$app->getSession()->setFlash('success', 'Esemény sikeresen létrehozva!');
            }else{
                Yii::$app->getSession()->setFlash('error', 'Belső hiba történt!');
            }
            return $this->actionEvents();
        }
        return $this->render('create',['model'=>$event]);
    }
}
