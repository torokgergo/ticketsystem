<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $user app\models\User */

$this->title = $user->name;

?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $user->id], ['class' => 'btn btn-primary']) ?>
    </p>

    <?= DetailView::widget([
        'model' => $user,
        'attributes' => [
            'email:email',
            'name',
            'room',
            'reg_date',
        ],
    ]) ?>

</div>
