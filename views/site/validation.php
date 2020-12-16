<?php

/* @var $this yii\web\View */



use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = 'J\'ATTEINS MON BUT - Payment info';
?>
  <div class="site-change wrap-content">
    <div class="row">
      <div class="col-md-6 offset-md-3">
        <h1 class="hero-title">
          <?= Html::encode('Thank you for using our website') ?>
        </h1>
        <br>

        <p>Please provide your billing information here to activete your account</p>
        <br>
        <div id="cc-form">
          <form method="post" id="payment-form">
            <label for="card-element"> Credit or debit card
            </label>
            <div id="card-element"></div>
            <div id="card-errors" role="alert"></div>
            <div class="text-center">
              <?=Html::button('Submit payment info',['class' => 'btn btn-primary', 'id' => 'pay-button', 'onclick' => 'generate()'])?>
                <?= Html::a('Back',['/site/settings'],['class'=>'btn']);?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php $this->registerJsFile('https://js.stripe.com/v3/'); ?>
  <?php $this->registerJsFile('@js/billingInfo.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>