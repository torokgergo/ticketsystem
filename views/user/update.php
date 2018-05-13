<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $user app\models\User */
/* @var $form yii\widgets\ActiveForm */

$this->title = 'Adatok szerkesztése';
$this->params['breadcrumbs'][] = $this->title;
?>

<div>
    <div class="container col-lg-4">

        <h1><?= Html::encode($this->title) ?></h1>

        <?php $form = ActiveForm::begin(); ?>

        <?= $form->field($user, 'name')->textInput(['maxlength' => true]) ?>

        <div class="form-group">
            <?= Html::submitButton('Mentés', ['class' => 'btn btn-success']) ?>

            <?= Html::a('Mégse',  Yii::$app->request->referrer, ['class' => 'btn btn-primary']) ?>
        </div>

        <?php ActiveForm::end(); ?>

    </div>
</div>
