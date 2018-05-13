<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Ticket;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Saját ticketek';
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Új ticket létrehozása', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [
            [
                'attribute' => 'status',
                'contentOptions' => function ($data) {
                    return ($data->status === Ticket::TYPE_OPENED) ? [
                        'class' => 'h4 text-uppercase text-success'
                    ] : [
                        'class' => 'h4 text-uppercase text-danger'
                    ];
                },
                'headerOptions' => ['class' => 'text-center col-lg-1'],
            ],
            [
                'attribute' => 'title',
                'content' => function ($ticket) {
                    return Html::a($ticket->title, ['ticket/view','id' => $ticket->id]);
                },
                'headerOptions' => ['class' => 'text-center col-lg-3'],
            ],
            [
                'attribute' => 'priority',
                'contentOptions' => function ($ticket) {
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
                'attribute' => 'admin_id',
                'content' => function ($ticket) {
                    $admin = $ticket->admin;
                    return $admin == NULL ? '[NEW]' : $admin->name;
                },
                'contentOptions' => function ($ticket) {
                    $admin = $ticket->admin;
                    return $admin == NULL ? ['class' => 'text-center h4 text-success'] : ['class' => 'text-left'];
                },
                'headerOptions' => ['class' => 'text-center col-lg-2'],
            ],
            [
                'attribute' => 'creation_date',
                'headerOptions' => ['class' => 'col-lg-2'],
            ],
            [
                'attribute' => 'last_modified',
                'headerOptions' => ['class' => 'col-lg-2'],
            ],
        ],
    ]); ?>

</div>
