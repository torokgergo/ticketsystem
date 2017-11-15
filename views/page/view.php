<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view text-center">

    <div class="title1 c"><h1><?= Html::encode($this->title) ?></h1></div>

    <div class="content"><?= Html::encode($model->content) ?></div>

    <p></p>
    <div class="c">Creator:</div>
    <div class="row">
      <div class="col-sm-4">

          <div class="username"> <?= $model->user->name ?></div>
      </div>

    <div class="regdate"> <?= $model->user->reg_date ?></div></div>

</div>
