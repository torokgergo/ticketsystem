<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $ticket app\models\Ticket */
/* @var $items array */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Szerkeszt';

?>
<div>

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($ticket,'priority')->dropDownList($items,['style'=>'width:100px']) ?>

    <?= $form->field($ticket, 'status')->dropDownList(['opened', 'closed'],['style'=>'width:100px']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>

        <?= Html::a('Mégse',  Yii::$app->request->referrer, ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
