<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
?>
    <?php $this->beginPage() ?>
    <!DOCTYPE html>
    <html lang="<?= Yii::$app->language ?>">

    <head>
        <link href="https://fonts.googleapis.com/css?family=Gothic+A1:400,600,700" rel="stylesheet">
        <meta charset="<?= Yii::$app->charset ?>">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="goal.ico">
        <?= Html::csrfMetaTags() ?>
            <title>
                <?= Html::encode($this->title) ?>
            </title>
            <?php $this->head() ?>
    </head>

    <body>
        <?php $this->beginBody() ?>

        <div class="wrap">
            <nav class="navbar navbar-expand-lg navbar-light bg-white fixed-top navbar-custom">
                <a class="navbar-brand" href="#">J'ATTEINS MON BUT</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <?php if(Yii::$app->user->isGuest):?>
                    <ul class="navbar-nav ml-auto mr-3">
                        <?= Html::a('Home', ['site/index'],['class' => 'nav-item nav-link ']) ?>
                        <?= Html::a('How it works', ['site/how-it-works'],['class' => 'nav-item nav-link']) ?>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?= Html::a('Sign in', ['site/login'],['class' => 'btn btn-secondary btn-signin d-sm-none d-md-block']) ?>
                            <?= Html::a('Sign in', ['site/login'],['class' => 'nav-link d-md-none d-sm-block']) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('Sign up', ['site/register'],['class' => 'btn btn-signup btn-primary d-sm-none d-md-block']) ?>
                            <?= Html::a('Sign up', ['site/register'],['class' => 'nav-link d-sm-block d-md-none']) ?>
                        </li>
                    </ul>
                    <?php else : ?>

                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item">
                            <?= Html::a('Home', ['site/home'],['class' => 'nav-link ']) ?>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <?= Html::a('Contact us', ['site/contact'],['class' => 'nav-link']) ?>
                        </li>
                        <li class="nav-item">
                            <?= Html::a('Settings', ['site/settings'],['class' => 'nav-link']) ?>
                           
                        </li>
                        <li class="nav-item">
                            <?= Html::a('Logout', ['site/logout'],['class' => 'btn-signup nav-link d-sm-block d-md-none', 'data-method'=>"post"]) ?>
                            <?= Html::a('Logout', ['site/logout'],['class' => 'btn btn-secondary btn-signup d-sm-none d-md-block', 'data-method' => 'post']) ?>
                        </li>
                    </ul>
                    <?php endif; ?>
                </div>
            </nav>

            <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
                <?= Alert::widget() ?>
                    <?= $content ?>
        </div>

        <footer class="footer">
            <div class="container">
                <p class="pull-left">&copy; J'ATTEINS MON BUT
                    <?= date('Y') ?>
                </p>

                <p class="pull-right">
                    <?= Yii::powered() ?>
                </p>
            </div>
        </footer>

        <?php $this->endBody() ?>
    </body>

    </html>
    <?php $this->endPage() ?>