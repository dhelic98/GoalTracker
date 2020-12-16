<?php

/* @var $this yii\web\View */



use yii\helpers\Html;

$this->title = 'Confirmation of registration';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="site-register-confirm wrap-content">
        <div class="container">
            <div class="row">
                <div class="col-md-8 offset-md-2 mt-5">
                    <div class="text-center">
                        <h1>
                            <?= Html::encode($this->title) ?>
                        </h1>
                        <p>Thank you for registering to our website, link for confirmation has been sent to this e-mail:
                        <?= $email ?>
                        </p>
                        <div>
                            <?= Html::a('Go to login', ['/site/login'], ['class'=>'btn btn-primary mt-2 mb-3']) ?>
                        </div>

                        <br>

                        <p>
                        Did not recieve your mail?
                        </p>
                        <div>
                            <?= Html::a('Resend', ['/site/resend','email'=>''.$email.'', 'id' => 'registration'], ['class'=>'btn btn-secondary']) ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        

    </div>