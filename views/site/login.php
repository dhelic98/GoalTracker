<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Login';

?>
<div class="site-login wrap-content">
<div class="container">
    <div class="row">
        <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
            <div class="card mt-5 mb-2">
                <div class="card-body ml-4 mr-4 mb-4 mt-4">
                    <div class="text-center">
                        <h1 class="h2"><?= Html::encode($this->title) ?></h1>
                        <p class="text-center">Please fill out the following fields to login</p>
                    </div>
                    
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                    ]); ?>
                        <?= $form->field($model, 'email', ['labelOptions' => ['class' => 'form-label']])->textInput(['autocomplete' => 'email', 'class' => 'form-control']); ?>
                        <?= $form->field($model, 'password', ['labelOptions' => ['class' => 'form-label']])->passwordInput(['class'=>'form-control', 'autocomplete' => 'new-password']); ?>
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>
                        
                    <div class="form-btns align-items-center d-flex justify-content-end">
                            <?=Html::a('Forgotten your password?', ['site/reset-password'], ['class' => 'mr-auto']) ?>
                        <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
  