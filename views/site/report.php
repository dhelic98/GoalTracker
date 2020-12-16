<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\Week */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Report';

?>
    <div class="site-login wrap-content">

        <div class="row">
            <div class="col-md-6 offset-md-3 offset-lg-4 col-lg-4 col-sm-8 offset-sm-2 col-8 offset-2 mt-3">
                <div class="card mt-5 mb-5">
                    <div class="card-body ml-4 mr-4 mb-4 mt-4">
                        <h1 class="hero-title">
                            <?= Html::encode('Report') ?>
                        </h1>
                        <?php $form = ActiveForm::begin([
                    'id' => 'report-form',
                    ]); ?>

                        <div class="form-group">
                            <?=  $form->field($model, 'report', ['labelOptions' => ['class' => 'form-label']])->textarea(['rows'=> '5'])?>
                        </div>

                        <div class="form-group">

                            <div class="form-btns d-flex justify-content-center">
                                <?= Html::a("Back",['/site/home'],['class' => 'btn btn-secondary mr-2',]) ?>
                                    <?= Html::submitButton('I have completed this week', ['class' => 'btn btn-primary', 'name' => 'report-button']) ?>
                            </div>


                            <?php ActiveForm::end(); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>