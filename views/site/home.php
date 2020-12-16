<?php

/* @var $this yii\web\View */
/* @var $model app\models\MyUser */
/* @var $goals app\models\Goals */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\ArrayHelper;


$this->title = 'J\'ATTEINS MON BUT - Home';
?>

    <div class="site-home wrap-content container">
        <div class="row">
            <div class="col-lg-3 mt-5">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center avatar">
                            <?= Html::img('uploads/'.$model->avatar.'', ['class' => 'img-thumbnail avatar']); ?>
                                <?= Html::tag('h2',$model->getFullName()); ?>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-9 col-12 mt-5">
                <div class="row">
                    <div class="col-12 d-flex justify-content-end">
                        <?= Html::a('Add new goal',['/site/add-new-goal'],['class'=>'btn btn-primary']);?>
                    </div>
                </div>
                <?php
                if(sizeof($goals)==0){
                    echo Html::tag('h2','No current goals.',['style' => 'margin-top: 5px;font-size:24px; margin-right: 20px']);
                }
                else{
                    foreach($goals as $goal){
                    
            ?>
                    <div class="row">
                        <div class="col-12">
                            <div class="card mt-3">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8 card-title mb-3 col-7">
                                            <div class="img-title">
                                                <img src="images/icon.svg " alt="goal-icon">
                                                <h5>
                                                    <?php
                                                echo $goal->goal;
                                            ?>
                                                </h5>
                                                <p class="card-text">
                                                    <small class="text-muted">
                                                        <?php
                                                echo 'Next report due '. $goal->date_due;
                                                ?>
                                                    </small>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="col-md-4 col-5">
                                            <p class="text-right">
                                                Week
                                                <?php
                                        echo $goal->getWeekPassed();
                                        ?>
                                                    of
                                                    <?php
                                        echo $goal->num_of_weeks;
                                        ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-6">
                                            <p class="stats-text">
                                                <span>Weeks succeeded</span>
                                                <?php
                                        echo $goal->weeks_succseded;
                                        ?>
                                            </p>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <p class="stats-text">
                                                <span>Weeks failed</span>
                                                <?php
                                        echo  $goal->weeks_failed;
                                        ?>
                                            </p>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <p class="stats-text">
                                                <span>Total money at stake</span>
                                                $
                                                <?php
                                        echo $goal->money_invested;
                                        ?>
                                            </p>
                                        </div>
                                        <div class="col-md-3 col-6">
                                            <p class="stats-text">
                                                <span>Stakes per week</span>
                                                $
                                                <?php
                                        echo $goal->getStakePerWeek();
                                        ?>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3 col-6 mt-3">
                                            <p class="stats-text">
                                                <span>Remaining stakes</span>
                                                $
                                                <?php
                                        echo $goal->getStakesLeft();
                                        ?>
                                            </p>
                                        </div>
                                        <div class="col-md-3 col-6 mt-3">
                                            <p class="stats-text">
                                                <span>Money lost</span>
                                                $
                                                <?php
                                        echo $goal->getMoneyLost();
                                        ?>
                                            </p>
                                        </div>
                                        <div class="col-md-6 col-12 mt-3">
                                            <?php 
                                        $date = date('d');
                                        $u_date = date('d', strtotime($goal->date_due.'- 3 days'));
                                        $month = date('m');
                                        $u_month = date('m', strtotime($goal->date_due.'- 3 days'));
                                        $year = date('Y');
                                        $u_year = date('Y', strtotime($goal->date_due.'- 3 days'));
                                        
                                        if($year>$u_year || $month>$u_month || $date >= $u_date):
                                            
                                ?>
                                            <div class="d-flex justify-content-end">
                                                <?= Html::a('Submit report',['site/report','id' =>$goal->id], ['class' => 'btn btn-success']) ?>
                                            </div>
                                            <?php else: ?>
                                            <div class="d-flex justify-content-end mt-3 mr-2">
                                                <?php $u_date = date('d.m.Y', strtotime($goal->date_due. '- 3 days'));
                                        echo 'Report disabled until '. $u_date;?>
                                            </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php }
            } ?>
                        </div>
                    </div>
            </div>
        </div>