<?php

/* @var $this yii\web\View */
/* @var $model app\models\MyUser */
/* @var $goals app\models\Goals */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = 'Password reset';


?>

    <div class="site-contact wrap-content">
        <div class="row">
            <div class="col-lg-6 offset-lg-3 col-md-8 offset-md-2 col-sm-10 offset-sm-1 col-10 offset-1">
                <div class="card mt-3 mb-5">
                    <div class="card-body ml-4 mr-4 mb-4 mt-4">
                        <h1 class="hero-title">
                            <?= Html::encode('Reset password') ?>
                        </h1>
                        <?php $form= ActiveForm::begin([
     'id' => 'email-form',
     ]);  ?>

                        <div class="form-group">
                            <?= $form->field($email, 'email', ['labelOptions' => ['class' => 'form-label']])->textInput(['autocomplete' => 'email', 'class' => 'form-control']); ?>
                        </div>

                        <div class="form-btns d-flex justify-content-end">
                            <?= Html::a('Back',['/site/login'],['class'=>'btn btn-secondary mr-3']);?>
                                <?= Html::submitButton('Submit', ['class' => 'submit btn btn-primary']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>