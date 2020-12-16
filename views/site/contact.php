<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Contact';
$this->params['breadcrumbs'][] = $this->title;
?>
    <div class="site-contact wrap-content">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-10 offset-1">
                <div class="card mt-3 mb-5">
                    <div class="card-body ml-4 mr-4 mb-4 mt-4">
                        <h1 class="hero-title">
                            <?= Html::encode('Contact us') ?>
                        </h1>

                        <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')): ?>

                        <div class="alert alert-success">
                            Thank you for contacting us. We will respond to you as soon as possible.
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="text-center">
                            <?= Html::a("Home",['/site/home'],['class' => 'btn btn-primary']) ?>
                        </div>

                        <?php else: ?>

                        <p>
                            If you have business inquiries or other questions, please fill out the following form to contact
                            us. Thank you.
                        </p>
                        <?php $form = ActiveForm::begin(['id' => 'contact-form',
                ]); ?>
                        <div class="form-group">
                            <label class="form-label" for="">Your email</label>
                            <?= $form->field($model, 'email')->textInput(['placeholder' => 'name@example.com'])->label(false) ?>

                        </div>
                        <div class="form-group row">
                            <div class="col-md-6">
                                <label class="form-label" for="">Your name</label>
                                <?= $form->field($model, 'name')->textInput(['placeholder' => 'Jane/John Doe'])->label(false) ?>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label" for="">Subject</label>
                                <?= $form->field($model, 'subject')->textInput(['placeholder' => 'Subject'])->label(false) ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="form-label" for="">Body</label>
                            <?= $form->field($model, 'body')->textarea(['rows' => 6])->label(false) ?>
                        </div>
                        <div class="form-group">
                            <div class="form-btns d-flex justify-content-end">
                                <?= Html::a('Back',['/site/settings'],['class'=>'btn btn-secondary mr-2']);?>
                                <?= Html::submitButton('Send', ['class' => 'btn btn-primary d-sm-none d-none d-md-block', 'name' => 'contact-button']) ?>
                                <?= Html::submitButton('Send', ['class' => 'btn btn-primary btn-cover d-block d-md-none', 'name' => 'contact-button']) ?>
                            </div>
                        </div>

                        <?php ActiveForm::end(); ?>



                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>