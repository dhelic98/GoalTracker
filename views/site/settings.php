<?php

/* @var $this yii\web\View */
/* @var $model app\models\MyUser */
/* @var $goals app\models\Goals */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;



$this->title = 'J\'ATTEINS MON BUT - Settings';
?>

    <div class="site-settings">
        <div class="row">
            <div class="offset-3 col-md-6">
                <div class="card mt-5 mb-2">
                    <div class="card-body ml-4 mr-4 mb-4 mt-4">
                        <h1 class="hero-title">Settings</h1>
                        <br>


                        <?php
                echo Html::tag('p','Change information about your account');
                echo Html::a('Change info', ['/site/change-info'],['class'=>'btn btn-secondary',]);
                echo '<br><br>';
                echo Html::tag('p','Change your password');
                echo Html::a('Change password', ['/site/change-password'],['class'=>'btn btn-secondary']);
                echo '<br><br>';
                echo Html::tag('p','Change your billing information');
                echo Html::a('Change billing', ['/site/change-billing-info'],['class'=>'btn btn-secondary']);

                ?>

                            <?php $form= ActiveForm::begin([
                        'id' => 'index-form',
                ]);  ?>
                            <div class="form-group mt-4">
                                <label class="form-label" for="">Profile avatar</label>
                                <?= $form->field($model, 'avatar', ['labelOptions' => ['class' => 'form-label']])->fileInput()->label(false) ?>
                            </div>
                                    <div class="d-flex">
                                        <?= Html::submitButton('Upload', ['class' => 'btn btn-secondary d-sm-none d-none d-md-block', 'name' => 'upload-button']) ?>
                                            <?= Html::submitButton('Upload', ['class' => 'btn btn-secondary btn-cover d-block d-md-none', 'name' => 'upload-button']) ?>
                                    </div>
                            <?php ActiveForm::end(); ?>
                            <br>
                            <br>

                            <div class="text-center">
                                <?= Html::a("Home",['/site/home'],['class' => 'btn btn-primary']) ?>
                            </div>
                    </div>
                </div>
            </div>
        </div>


    </div>