<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>
    <h1>Create event</h1>
<?php
$form = ActiveForm::begin([
    'id' => 'login-form',
    'options' => ['class' => 'form-horizontal'],
])
?>
<?= $form->field($event, 'event_name') ?>
<?= $form->field($event, 'description') ?>
<?= $form->field($event, 'event_date') ?>

    <div class="form-group">
        <div class="col-lg-offset-1 col-lg-11">
            <?= Html::submitButton('Create', ['class' => 'btn btn-primary']) ?>
        </div>
    </div>
<?php ActiveForm::end() ?>