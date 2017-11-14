<?php
    use yii\helpers\Html;
    use yii\widgets\ActiveForm;

    $this->title = 'Register';
?>
<h1>Registration Form</h1>
<?php
    $form = ActiveForm::begin([
        'id' => 'login-form',
        'options' => ['class' => 'form-horizontal'],
    ])
?>
<?= $form->field($user, 'email') ?>
<?= $form->field($user, 'name') ?>
<?= $form->field($user, 'room') ?>
<?= $form->field($user, 'password')->passwordInput() ?>

<div class="form-group">
    <div class="col-lg-offset-1 col-lg-11">
        <?= Html::submitButton('Register', ['class' => 'btn btn-primary']) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
