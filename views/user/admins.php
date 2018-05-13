<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Adminok';
?>
<div>
    <div class="col-lg-6">
        <h1><?= Html::encode($this->title) ?></h1>

        <p>
            <?= Html::a('Új admin létrehozása', ['site/create-admin'], ['class' => 'btn btn-success']) ?>
        </p>

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
                [
                    'attribute' => 'name',
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
