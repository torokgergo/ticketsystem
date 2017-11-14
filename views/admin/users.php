<?php
use yii\grid\GridView;

    $this->title = 'Users';
?>
<?= GridView::widget([
    'dataProvider' => $dataProvider,
    'columns' => [
        'id',
        'email',
        'name',
        'room',
        'permission',
        'reg_date',
        ['class' => 'yii\grid\ActionColumn']
    ],
]) ?>