<?php

namespace app\controllers;

use app\models\Ticket;
use app\models\User;
use app\models\Message;
use yii;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

class TicketController extends \yii\web\Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['own', 'create', 'view', 'admin-view', 'opened', 'closed', 'take', 'user-ticket', 'update'],
                'rules' => [
                    [
                        'actions' => ['own', 'create', 'view'],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function($role, $action) {
                            return !User::isUserAdmin(Yii::$app->user->identity->email);
                        }
                    ],
                    [
                        'actions' => ['admin-view', 'opened', 'closed', 'take', 'user-ticket', 'update'],
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

    public function actionOwn()
    {
        $query = Ticket::find()->where(['creator_id' => Yii::$app->user->id]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_DESC,
                    'last_modified' => SORT_DESC,
                ]
            ]
        ]);

        return $this->render('own', ['dataProvider' => $provider]);
    }

    public function actionCreate()
    {
        $ticket = new Ticket();

        $items = ['normal', 'urgent', 'critical'];

        if ($ticket->load(Yii::$app->request->post())) {
            $ticket->priority = Ticket::PRIORITY[$ticket->priority];
            $ticket->status = Ticket::TYPE_OPENED;
            $ticket->creator_id = Yii::$app->user->id;
            if ($ticket->save()) {
                Yii::$app->getSession()->setFlash('success', 'A ticketet sikeresen létrehoztam!');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Belső hiba történt!');
            }
            return $this->redirect('own');
        }

        return $this->render('create', ['ticket' => $ticket, 'items' => $items]);
    }

    public function actionView($id)
    {
        $ticket = Ticket::find()->where(['id' => $id])->one();

        $message = new Message();

        if ($message->load(Yii::$app->request->post())) {
            $message->author_id = Yii::$app->user->id;
            $message->save();
            $ticket->status = Ticket::TYPE_OPENED;
            $ticket->save();
        }

        $messages = Message::find()->where(['ticket_id' => $ticket->id])->orderBy(['creation_date' => SORT_DESC])->all();

        return $this->render('view', ['ticket' => $ticket, 'message' => $message, 'messages' => $messages]);
    }

    public function actionAdminView($id)
    {
        $ticket = Ticket::find()->where(['id' => $id])->one();

        $message = new Message();

        if ($message->load(Yii::$app->request->post())) {
            $message->author_id = Yii::$app->user->id;
            $message->save();
            $ticket->status = Ticket::TYPE_OPENED;
            $ticket->save();
        }

        $messages = Message::find()->where(['ticket_id' => $ticket->id])->orderBy(['creation_date' => SORT_DESC])->all();

        return $this->render('admin_view', ['ticket' => $ticket, 'message' => $message, 'messages' => $messages]);
    }

    public function actionOpened()
    {
        $query = Ticket::find()->where(['status' => Ticket::TYPE_OPENED]);
        $title = 'Nyitott ticketek';

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'last_modified' => SORT_DESC,
                ]
            ]
        ]);

        return $this->render('list', ['dataProvider' => $provider, 'title' => $title]);
    }

    public function actionClosed()
    {
        $query = Ticket::find()->where(['status' => Ticket::TYPE_CLOSED]);
        $title = 'Zárt ticketek';

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'last_modified' => SORT_DESC,
                ]
            ]
        ]);

        return $this->render('list', ['dataProvider' => $provider, 'title' => $title]);
    }

    public function actionTake($ticket_id, $admin_id)
    {
        $ticket = Ticket::find()->where(['id' => $ticket_id])->one();
        $ticket->admin_id = $admin_id;
        if ($ticket->save()) {
            Yii::$app->getSession()->setFlash('success', 'A ticketet sikeresen elvettem!');
        } else {
            Yii::$app->getSession()->setFlash('error', 'Belső hiba történt!');
        }

        return $this->redirect('opened');
    }

    public function actionUserTicket($id)
    {
        $user = User::find()->where(['id' => $id])->one();
        $query = Ticket::find()->where(['creator_id' => $id]);

        $provider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 20,
            ],
            'sort' => [
                'defaultOrder' => [
                    'status' => SORT_DESC,
                    'last_modified' => SORT_DESC,
                ]
            ]
        ]);

        return $this->render('userTicket', ['dataProvider' => $provider, 'user' => $user]);
    }

    public  function actionUpdate($id)
    {
        $ticket = Ticket::find()->where(['id' => $id])->one();

        $items = ['normal', 'urgent', 'critical'];

        if ($ticket->load(Yii::$app->request->post())) {
            $ticket->priority = Ticket::PRIORITY[$ticket->priority];
            $ticket->status = Ticket::STATUS[$ticket->status];
            if ($ticket->save()) {
                Yii::$app->getSession()->setFlash('success', 'A ticketet sikeresen frissítettem!');
            } else {
                Yii::$app->getSession()->setFlash('error', 'Belső hiba történt!');
            }
            return $this->redirect('own');
        }

        return $this->render('update', ['ticket' => $ticket, 'items' => $items]);
    }
}
