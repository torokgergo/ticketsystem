<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Felhasználók';
?>
<div>
    <div class="col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'name',
                    'content' => function ($user)
                    {
                        return Html::a($user->name, ['ticket/user-ticket','id' => $user->id]);
                    },
                    'headerOptions' => ['class' => 'text-center col-lg-2'],
                ],
                [
                    'attribute' => 'registration_date',
                    'headerOptions' => ['class' => 'col-lg-2'],
                ],
                [
                'attribute' => 'last_login_date',
                    'headerOptions' => ['class' => 'col-lg-2'],
                ]
            ],
        ]); ?>
    </div>
</div>
