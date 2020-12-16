<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\RegisterForm */


use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;

$this->title = 'Change information';

?>
    <div class="site-register wrap-content">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2">
                    <div class="card mt-5 mb-5">
                        <div class="card-body ml-4 mr-4 mb-4 mt-4">
                            <div class="text-center">
                                <h1 class="h2">
                                    <?= Html::encode($this->title) ?>
                                </h1>
                                <p>Please fill out the following fields to register:</p>
                            </div>

                            <?php $form= ActiveForm::begin([
                            'id' => 'change-form',
                        ]);  ?>

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
                                <?= Html::a('Back',['/site/settings'],['class'=>'btn btn-secondary mr-3']);?>
                                    <?= Html::submitButton('Submit', ['class' => 'btn btn-primary', 'name' => 'register-button']) ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php ActiveForm::end(); ?>
    </div>