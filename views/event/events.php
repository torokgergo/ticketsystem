<?php

use yii\helpers\Html;
use yii\grid\GridView;

    $this->title = 'Events';
?>
    <div class="user-view">

        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Create', ['create'], ['class' => 'btn btn-primary']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                'event_name',
                'description',
                'event_date',
                [
                'header' => 'Sign Up',
                'content' => function($model) {
                    return Html::a('Sign up',['event/sign', 'id' => $model->id], ['class' => 'btn btn-primary']);
                }
                ],

            ],
        ])

        ?>
    </div>
