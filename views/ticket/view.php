<?php

use yii\helpers\Html;
use yii\i18n\Formatter;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $ticket app\models\Ticket */
/* @var $message app\models\Message */

$this->title = $ticket->title;
$formatter = new Formatter();
?>
<div class="container">

    <h1><?= Html::encode($this->title) ?></h1>

    <div class="row">
        <div class="col-lg-1">
            ID:
            <div class="panel panel-default panel-footer">
                <?= $ticket->id; ?>
            </div>
        </div>
        <div class="col-lg-1">
            Prioritás:
            <div class="panel panel-default panel-footer">
                <?= $ticket->priority; ?>
            </div>
        </div>
        <div class="col-lg-4">
            Cím:
            <div class="panel panel-default panel-footer">
                <?= $ticket->title; ?>
            </div>
        </div>
        <div class="col-lg-3">
            Feladó:
            <div class="panel panel-default panel-footer">
                <?= $ticket->creator->name; ?>
            </div>
        </div>
        <div class="col-lg-3">
            Admin:
            <div class="panel panel-default panel-footer">
                <?= $ticket->admin == NULL ? "[NEW]" : $ticket->admin->name; ?>
            </div>
        </div>
    </div>

    Leírás:
    <div class="panel panel-default panel-footer">
        <?= $formatter->asNtext($ticket->content); ?>
    </div>

    <div class="row">
        <div class="col-lg-3">
            Létrehozva:
            <div class="panel panel-default panel-footer">
                <?= $ticket->creation_date; ?>
            </div>
        </div>
        <div class="col-lg-3">
            Utoljára módosítva:
            <div class="panel panel-default panel-footer">
                <?= $ticket->last_modified; ?>
            </div>
        </div>
    </div>

    <div class="form-group">
        <?= Html::a( 'Vissza', Yii::$app->request->referrer, ['class' => 'btn btn-primary']) ?>
    </div>

</div>
<div class="container">
    <div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($message, 'content')->textarea(['rows' => 3]) ?>

    <?= Html::activeHiddenInput($message, 'ticket_id', ['value' => $ticket->id]) ?>

    <div class="form-group">
        <?= Html::submitButton('Küld', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    </div>
</div>
<div class="container">
    <?php foreach ($messages as $msg): ?>
        <div class="h4"> <?= $msg->author->name ?>: </div>
        <div class="panel panel-default">
            <div class="panel-heading">
                <?= $formatter->asNtext($msg->content); ?>
            </div>
            <div class="panel-body">
                <?= $msg->creation_date ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
