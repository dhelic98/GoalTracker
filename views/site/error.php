<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>
    <div class="site-error wrap-content">
        <div class="row">
        <div class="col-md-6 offset-3">

            <h1 class="hero-title mt-3">
                <?= Html::encode($this->title) ?>
            </h1>

            <div class="alert alert-danger">
                <?= nl2br(Html::encode($message)) ?>
            </div>

            <p>
                The above error occurred while the Web server was processing your request.
            </p>
            <p>
                Please contact us if you think this is a server error. Thank you.
            </p>
            <?= Html::a('Contact us',['/site/contact'], ['class' => 'btn btn-primary', 'style' => 'font-size: 20px']) ?>
            </div>
        </div>
    </div>