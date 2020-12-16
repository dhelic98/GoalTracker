<?php

/* @var $this yii\web\View */
/* @var $goals app\models\ChangePassword */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = 'Change password';
?>

    <div class="site-change wrap-content">
        <div class="row">
            <div class="col-lg-4 offset-lg-4 col-md-8 offset-md-2">
                <div class="card mt-5 mb-2">
                    <div class="card-body ml-4 mr-4 mb-4 mt-4">
                    <h1 class="hero-title mr-3">Change password</h1>
                        <?php $form= ActiveForm::begin([
     'id' => 'info-form',
     ]);  ?>
                        <div class="form-group">
                            <?= $form->field($pass, 'oldPassword', ['labelOptions' => ['class' => 'form-label']])->passwordInput(['class'=>'form-control', 'autocomplete' => 'new-password']); ?>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <?= $form->field($pass, 'newPassword', ['labelOptions' => ['class' => 'form-label']])->passwordInput(['class'=>'form-control', 'autocomplete' => 'new-password']); ?>
                            </div>
                            <div class="col-md-6">
                                <?= $form->field($pass, 'confirmPassword', ['labelOptions' => ['class' => 'form-label']])->passwordInput(['class'=>'form-control', 'autocomplete' => 'new-password']); ?>
                            </div>
                        </div>
                        </br>

                        <div class="d-flex justify-content-end">
                            <?= Html::a('Back',['/site/settings'],['class'=>'btn btn-secondary mr-3']);?>
                                <?= Html::submitButton('Change', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>