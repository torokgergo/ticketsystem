<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Ticket;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */
/* @var $title string */

$this->title = $title;
?>
<div class="ticket-index">
    <div class="container col-lg-9">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'title',
                    'content' => function ($ticket)
                    {
                        return Html::a($ticket->title, ['ticket/admin-view','id' => $ticket->id]);
                    },
                    'headerOptions' => ['class' => 'text-center col-lg-3'],
                ],
                [
                    'attribute' => 'priority',
                    'contentOptions' => function ($ticket)
                    {
                        switch ($ticket->priority) {
                            case Ticket::TYPE_NORMAL:
                                return ['class' => 'text-center h4 text-success'];
                            case Ticket::TYPE_URGENT:
                                return ['class' => 'text-center h4 text-warning'];
                            case Ticket::TYPE_CRITICAL:
                                return ['class' => 'text-center h4 text-danger'];
                        }
                    },
                    'headerOptions' => ['class' => 'text-center col-lg-1'],
                ],
                [
                    'attribute' => 'creator_id',
                    'content' => function ($ticket)
                    {
                        return $ticket->creator->name;
                    },
                    'headerOptions' => ['class' => 'text-center col-lg-2'],
                ],
                [
                    'attribute' => 'admin_id',
                    'content' => function ($ticket)
                    {
                        $admin = $ticket->admin;
                        return $admin == NULL ? '[NEW]' : $admin->name;
                    },
                    'contentOptions' => function ($ticket)
                    {
                        $admin = $ticket->admin;
                        return $admin == NULL ? ['class' => 'text-center h4 text-success'] : ['class' => 'text-left'];
                    },
                    'headerOptions' => ['class' => 'text-center col-lg-2'],
                ],
                [
                    'content' => function($ticket)
                    {
                        $admin = $ticket->admin;
                        if ($admin == NULL) {
                            return Html::a('Elvesz',
                                ['ticket/take','ticket_id' => $ticket->id,'admin_id' => Yii::$app->user->id],
                                ['class' => 'btn btn-xs btn-primary']);
                        } else {
                            return 'Foglalt';
                        }
                    },
                    'contentOptions' => ['class' => 'text-center'],
                    'headerOptions' => ['class' => 'col-lg-1'],
                ],
            ],
        ]); ?>

    </div>
</div>
