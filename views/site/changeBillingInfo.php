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
        <h1 class="hero-title mt-5">
          <?= Html::encode('Change billing info') ?>
        </h1>
        <br>

        <p>You can change your billing info here</p>
        <br>
        <div id="cc-form">
          <form method="post" id="payment-form">
            <label for="card-element"> Credit or debit card
            </label>
            <div id="card-element"></div>
            <div id="card-errors" role="alert"></div>
            <div class="text-center">
                <?= Html::a('Back',['/site/settings'],['class'=>'btn btn-secondary']);?>
              <?=Html::button('Submit payment info',['class' => 'btn btn-primary', 'id' => 'pay-button', 'onclick' => 'generate()'])?>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <?php $this->registerJsFile('https://js.stripe.com/v3/'); ?>
  <?php $this->registerJsFile('js/billingInfo.js', ['depends' => [\yii\web\JqueryAsset::className()]]); ?>