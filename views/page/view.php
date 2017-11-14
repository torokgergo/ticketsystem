<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Page */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="page-view">

    <div class="title1"><h1><?= Html::encode($this->title) ?></h1></div>




<?php//= DetailView::widget([
//        'model' => $model,
//        'attributes' => [
//            'id',
//            'title',
//            'content:ntext',
//            'create_date',
//            'user_id',
//        ],
//    ]) ?>

</div>
