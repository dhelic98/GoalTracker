<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "week_info".
 *
 * @property int $id
 * @property int $goal_id
 * @property int $week_number
 * @property int $status
 * @property string $report
 *
 * @property Goals $goal
 */
class Week extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'week_info';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['report'], 'required', 'message' => 'This field needs to be filled'],
            [['week_number', 'status'], 'integer'],
            [['report'], 'string', 'min' => 30, 'message' => 'Enter at least 30 characters'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goal_id' => 'Goal ID',
            'week_number' => 'Week Number',
            'status' => 'Status',
            'report' => 'Report',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoal()
    {
        return $this->hasOne(Goals::className(), ['id' => 'goal_id']);
    }
    
    public static function saveWeek($goal){
        $week = new Week();
        $week->goal_id = $goal->id;
        $week->week_number = $goal->getWeekPassed();
        $week->status = 0;
        $week->save(false);
    }

    public function updateWeek($goal){
        $this->status = 1;   
        $this->save();
        $goal->weeks_succseded++;
        $goal->weeks_left--;
        $goal->date_due = $goal->getNextDate();
        $goal->save();
        Week::saveWeek($goal);
    }

    
}
