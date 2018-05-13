<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $ticket app\models\Ticket */
/* @var $items array */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Ticket létrehozása';
?>
<div>

    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($ticket,'priority')->dropDownList($items,['style'=>'width:100px']) ?>

    <?= $form->field($ticket, 'title')->textInput(['maxlength' => true, 'style'=>'width:300px']) ?>

    <?= $form->field($ticket, 'content')->textarea(['rows' => 6]) ?>

    <div class="form-group">
        <?= Html::submitButton('Létrehozás', ['class' => 'btn btn-success']) ?>

        <?= Html::a('Mégse',  Yii::$app->request->referrer, ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
