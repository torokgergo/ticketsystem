<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->title = $user->name . ' adatai';
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

        <div class="form-group">
            <?= Html::a('Felhasználó törlése', ['user/delete', 'id' => $user->id], ['class' => 'btn btn-danger']) ?>
        </div>
    </div>
</div>
