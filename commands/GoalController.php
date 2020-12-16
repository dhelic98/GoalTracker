<?php
/**
 */

namespace app\commands;

use Stripe\Stripe;
Stripe::setApiKey("sk_test_6bSuPDvYpO059qqhHIJ4heDA");


use yii\console\Controller;
use yii\console\ExitCode;

use app\models\MyUser;
use app\models\Goals;
use app\models\Week;




class GoalController extends Controller
{
    

    public function actionDeleteUnused(){
        while(($users=MyUser::find()->where(['status' =>0])->limit(100)->all()) != null){
            foreach($users as $user){
                $user->delete();
            }

        }
        

    }

    public function actionProccesGoal(){
        $due_date = date('d.m.Y');
        while(($goals=Goals::find()->where(['date_due' => $due_date])->limit(100)->all()) != null){
            foreach($goals as $goal){
               GoalController::proccesPayment($goal);
                
                
            }
            break;
        }
    }

    public static function proccesPayment($goal){
        $weeks = $goal->weekInfos;
        $week = $weeks[$goal->getWeekPassed()-1];
        if($week->status ==0 && $week->report == null){
            GoalController::charge($goal);
        }
    }

    public static function charge($goal){
        $user = MyUser::find()->where(['id' => $goal->user_id])->limit(1)->one();
        $customer = $user->billing_info;
         \Stripe\Charge::create(array(
            "amount" => $goal->getStakePerWeek()*100,
            "currency" => "usd",
            "customer" => $customer,
            "description" => "Charge for goal track website, for failing the week"
          ));
        GoalController::updateDate($goal);
    }

    public static function updateDate($goal){
        $goal->weeks_left-=1;
        $goal->weeks_failed+=1;
        $goal->date_due= $goal->getNextDate();
        $goal->save();
        Week::saveWeek($goal);

    }

    

}

?>