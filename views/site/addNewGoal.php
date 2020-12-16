<?php

/* @var $this yii\web\View */
/* @var $model app\models\MyUser */
/* @var $goals app\models\Goals */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = 'Add a new goal';
?>
    <div class="site-add-goal wrap-content">
        <div class="row">
            <div class="col-lg-4 offset-1  col-md-6 col-sm-8 col-10 align-center mt-5">
                <h1 class="hero-title mt-5">
                    <?= Html::encode('Add new commitment') ?>
                </h1>
                <?php $form = ActiveForm::begin([
        'id' => 'add-new-form',
        ]); ?>
                <div class="form-group">
                    <label class="form-label" for="">Your Goal</label>
                    <?= $form->field($goal, 'goal')->textarea(['rows'=> '5', 'class' => 'form-control', 'placeholder' => 'Describe your goal...'])->label(false)?>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        <label class="form-label" for="">Money invested</label>
                        <?= $form->field($goal, 'money_invested',[ 'inputTemplate' => '<div class="input-group"> <div class="input-group-prepend"><span class="input-group-text">$</span></div>{input}</div>',])->textInput(['placeholder'=>"Amount"])->label(false)?>
                    </div>
                    <div class="col-md-6">
                        <label class="form-label" for="">Number of weeks</label>
                        <?= $form->field($goal, 'num_of_weeks')->textInput(['placeholder' => 'Number'])->label(false) ?>
                    </div>
                </div>
                <div class="form-btns d-flex justify-content-end">
                    <?= Html::a("Back",['/site/home'],['class' => 'btn btn-secondary mr-2',]) ?>
                        <?= Html::submitButton('Add', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>
            </div>

            <?php ActiveForm::end();?>

        </div>
    </div>