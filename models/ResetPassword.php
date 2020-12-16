<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 *
 * @property string $oldPassword
 * @property string $newPassword
 * @property string $confirmPassword
 *
 */
class ResetPassword extends Model
{

    public $newPassword;
    public $confirmPassword;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['newPassword', 'confirmPassword'],'required', 'message' => 'This field is required'],
            [['newPassword', 'confirmPassword'],'string', 'min' => 8, 'max' => 60],
            [['newPassword', 'confirmPassword'], 'confirmPassword'],
        ];
    }

     /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'users';
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'newPassword' => 'New password',
            'confirmPassword' => 'Confirm password',
            
        ];
    }

    

    public function confirmPassword($attribute){
        if($this->confirmPassword != $this->$attribute){
            $this->addError($attribute, 'Passwords must match');
        }
    }

   
}