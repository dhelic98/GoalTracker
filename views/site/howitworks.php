<?php

/* @var $this yii\web\View */
/* @var $model app\models\MyUser */
/* @var $goals app\models\Goals */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = 'J\'ATTEINS MON BUT - How it works';
?>
    <div class="site-hiw">
        <div class="row">
            <div class="offset-md-7 col-md-5 align-center">
                <h1 class="hero-title mt-5">
                    <?= Html::encode('How it works') ?>
                </h1>
                <p class="how-it-works">
                    We all have goals...
                    <br> Yet, most of us struggle to achieve our
                    <br> goals. That's because there's a big
                    <br> difference between having a goal and
                    <br> achieving a goal-j'atteins mon but works
                    <br> by helping people eliminate this gap by
                    <br> using, what we call, a Commitmnet
                    <br> Contract
                    <br>
                    <br> By asking our users to sign Commitment
                    <br> Contracts, j'atteins mon but helps users define their
                    <br> goal(whatever it may be), acknowledge
                    <br> what it'll take to accomplish it, and
                    <br> leverage the power of putting money on
                    <br> the line to turn that goal into reality
                </p>
                <div>
                    <?= Html::a('Contact us',['/site/contact'], ['class' => 'btn btn-secondary btn-large',]) ?>
                </div>
            </div>

        </div>
    </div>
    