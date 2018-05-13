<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
    use yii\widgets\ActiveForm;

$this->title = 'Admin Létrehozása';

?>
<div class="container col-lg-4">

    <h1><?= Html::encode($this->title) ?></h1>

    <?php
    $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
    ])
    ?>

    <?= $form->field($user, 'name') ?>

    <?= $form->field($user, 'email') ?>

    <?= $form->field($user, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Létrehoz', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
