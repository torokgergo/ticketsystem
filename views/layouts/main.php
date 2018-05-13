<?php

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use app\assets\AppAsset;
use app\models\Page;
use app\models\User;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody();
?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Ticket System',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar navbar-inverse navbar-static-top',
            'role' => 'navigation',
        ],
    ]);
        if (yii::$app->user->isGuest) {
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Regisztráció', 'url' => ['/site/registration']],
                    ['label' => 'Bejelentkezés', 'url' => ['/site/login']],
                ],
            ]);
        } elseif (!User::isUserAdmin(Yii::$app->user->identity->email)) {
            echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right'],
                    'items' => [
                        ['label' => 'Profil', 'url' => ['/user/profile']],
                        ['label' => 'Saját Ticketek', 'url' => ['/ticket/own']],
                        ['label' => 'Kilépés (' . Yii::$app->user->identity->email . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                    ],
            ]);
        } else {
            echo Nav::widget([
                'options' => ['class' => 'navbar-nav navbar-right'],
                'items' => [
                    ['label' => 'Profil', 'url' => ['/user/profile']],
                    ['label' => 'Nyitott Ticketek', 'url' => ['/ticket/opened']],
                    ['label' => 'Zárt Ticketek', 'url' => ['/ticket/closed']],
                    ['label' => 'Adminok', 'url' => ['/user/admins']],
                    ['label' => 'Felhasználók', 'url' => ['/user/list']],
                    ['label' => 'Kilépés (' . Yii::$app->user->identity->email . ')', 'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']],
                ],
            ]);
        }
    NavBar::end();
    ?>

    <div class="container">
        <?php if (Yii::$app->session->hasFlash('error')): ?>
            <div class="alert alert-danger alert-dismissable"><?= Yii::$app->session->getFlash('error'); ?></div>
        <?php endif; ?>
        <?php if (Yii::$app->session->hasFlash('success')): ?>
            <div class="alert alert-success alert-dismissable"><?= Yii::$app->session->getFlash('success'); ?></div>
        <?php endif; ?>
        <?= $content ?>
    </div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
