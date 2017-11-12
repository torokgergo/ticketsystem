<?php
use yii\grid\GridView;
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