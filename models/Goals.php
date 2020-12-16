<?php

namespace app\models;


use Yii;


/**
 * This is the model class for table "goals".
 *
 * @property int $id
 * @property int $user_id
 * @property string $goal
 * @property int $money_invested
 * @property string $start_date
 * @property int $num_of_weeks
 * @property int $weeks_failed
 * @property int $weeks_left
 * @property int $weeks_succseded
 * @property string $date_due
 *
 * @property Users $user
 * @property Week[] $weekInfos
 */
class Goals extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goals';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[ 'goal', 'money_invested', 'num_of_weeks'], 'required'],
            [['num_of_weeks', 'money_invested' ], 'integer'],
            [['goal', ], 'string'],
            [['num_of_weeks'], 'integer', 'max' => 52, 'min' => 1]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'goal' => 'Goal',
            'money_invested' => 'Money Invested     ',
            'start_date' => 'Start Date',
            'end_date' => 'End Date',
            'num_of_weeks' => 'Number Of Weeks',
            'weeks_failed' => 'Weeks Failed',
            'weeks_succseded' => 'Weeks Succseded',
            'days_passed' => 'Days Passed',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }

    public static function findById($id){
        return self::findOne(['id' => "$id" ]);

    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWeekInfos()
    {
        return $this->hasMany(Week::className(), ['goal_id' => 'id']);
    }

    public function saveGoal(){
        $this->start_date = date('d.m.Y');
        $this->weeks_left = $this->num_of_weeks;
        $this->weeks_failed = 0;
        $this->weeks_succseded= 0;
        $this->date_due= $this->getNextDate();
        $this->save();
        Week::saveWeek($this);

    }

    public static function getDate(){
        return date('d.m.Y');
    }

    public function getNextDate(){
        $num = $this->getWeekPassed()*7;
        return date('d.m.Y', strtotime($this->start_date. " + $num days"));

        
        
    }

    public function getWeekPassed(){
        return ($this->weeks_succseded + $this->weeks_failed + 1);
    }

    public function getStakesLeft(){
        return ($this->weeks_left)* $this->getStakePerWeek();
    }

    public function getStakePerWeek(){
        $stake = $this->money_invested/   $this->num_of_weeks;
        return number_format((float)$stake, 2, '.', '');
    }

    public function getMoneyLost(){
        $money = $this->weeks_failed * $this->getStakePerWeek();
        return number_format((float)$money,2,'.','');
    }


}
