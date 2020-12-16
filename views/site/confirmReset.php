<?php

/* @var $this yii\web\View */
/* @var $model app\models\MyUser */
/* @var $goals app\models\Goals */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = 'Password reset';


?>

    <div class="site-change wrap-content">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 col-md-8 offset-md-2">
                <div class="card mt-5 mb-2">
                    <div class="card-body ml-4 mr-4 mb-4 mt-4">
                        <h1 class="hero-title">
                            <?= Html::encode($this->title) ?>
                        </h1>
                        <br>

                        <p>Password changed successfully
                        </p>
                        <br>
                        <div>
                            <?= Html::a('Go to login', ['/site/login'], ['class'=>'btn btn-primary']) ?>
                        </div>
                    </div>

                </div>

            </div>

        </div>
    </div>