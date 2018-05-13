<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->title = 'Saját Adatok';
?>
<div>
    <div class="container col-lg-5">

        <h1><?= Html::encode($this->title) ?></h1>

        <?= DetailView::widget([
            'model' => $user,
            'attributes' => [
                [
                    'attribute' => 'name',
                    'format' => 'raw',
                    'value' => function($user) {
                        return Html::a($user->name, ['user/update','id' => $user->id]);
                    }
                ],
                'email',
                'registration_date',
                'last_login_date',
            ],
        ]) ?>
    </div>
</div>
