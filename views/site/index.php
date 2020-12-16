<?php

/* @var $this yii\web\View */
/* @var $model app\models\RegisterForm */
/* @var $goal app\models\Goals */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = 'Begin your commitment';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-index">
    <div class="container-fluid">
        <div class="row full-height">
            <div class="col-lg-4 col-md-6 offset-md-6 offset-lg-7 col-sm-8 offset-sm-2 col-10 offset-1  mb-5 align-center">
                <h1  class="hero-title">    
                    <?= Html::encode($this->title) ?>
                </h1>
                <?php $form= ActiveForm::begin([
                        'id' => 'index-form',
                ]);  ?>
                <div class="form-slide">
                        <?= $form->field($goal, 'goal', ['labelOptions' => ['class' => 'form-label']])->textarea(['class'=>'form-control', 'rows'=> '3']); ?>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($goal, 'money_invested', [
                                'labelOptions' => ['class' => 'form-label'],
                                'inputTemplate' => '<div class="input-group"><div class="input-group-prepend"><span class="input-group-text">$</span></div>{input}</div>',
                            ]); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($goal, 'num_of_weeks', ['labelOptions' => ['class' => 'form-label']])->textInput(['class'=>'form-control']); ?>
                        </div>
                    </div>
                    <div class="form-btns">
                        <button type="button" class="btn btn-primary btn-cover btn-next-js" name="goal-button">Continue</button>
                    </div>
                </div>
                <div class="form-slide">
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'first_name', ['labelOptions' => ['class' => 'form-label']])->textInput(['class'=>'form-control', 'autocomplete' => 'given-name']); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'last_name', ['labelOptions' => ['class' => 'form-label']])->textInput( ['class'=>'form-control', 'autocomplete' => 'family-name   ']); ?>
                        </div>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'email', ['labelOptions' => ['class' => 'form-label']])->textInput(['autocomplete' => 'email', 'class' => 'form-control']); ?>
                    </div>
                    <div class="form-group">
                        <?= $form->field($model, 'confirmEmail', ['labelOptions' => ['class' => 'form-label']])->textInput(['class'=>'form-control', 'autocomplete' => 'email']); ?>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'password', ['labelOptions' => ['class' => 'form-label']])->passwordInput(['class'=>'form-control', 'autocomplete' => 'new-password']); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'confirmPassword', ['labelOptions' => ['class' => 'form-label']])->passwordInput(['class'=>'form-control', 'autocomplete' => 'new-password']); ?>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'age', ['labelOptions' => ['class' => 'form-label']])->textInput(['class'=>'form-control', 'autocomplete' => 'on']); ?>
                        </div>
                        <div class="col-md-6">
                            <?= $form->field($model, 'gender', ['labelOptions' => ['class' => 'form-label']])->dropDownList([
                                'Male' => 'Male',
                                'Female' => 'Female',
                                'Other' => 'Other'
                                ],
                                [
                                'prompt' => "Choose a gender",
                            ]); ?>
                        </div>
                    </div>
                    <div class="form-btns d-flex justify-content-end">
                        <button id="goalNext" type="button" class="btn btn-secondary btn-cover btn-prev-js mr-2" name="goal-button">Back</button>
                        <?= Html::submitButton('Register', ['class' => 'btn btn-cover btn-primary', 'name' => 'register-button']) ?>
                    </div>
                </div>
                <?php ActiveForm::end(); ?>
                <div class ="text-center">
                    <span class="dot dot-border active"></span>
                    <span class="dot dot-border"></span>
                </div>
            </div>
        </div>
    </div>
</div>


<?php $this->registerJsFile('js/formSwitch.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>




