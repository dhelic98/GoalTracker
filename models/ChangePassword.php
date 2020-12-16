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
class ChangePassword extends Model
{

    public $oldPassword;
    public $newPassword;
    public $confirmPassword;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['oldPassword','newPassword', 'confirmPassword'],'required', 'message' => 'This field is required'],
            [['oldPassword','newPassword', 'confirmPassword'],'string', 'min' => 8, 'max' => 60],
            [['newPassword', 'confirmPassword'], 'confirmPassword'],
            [['oldPassword'], 'checkPassword'],
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
            'oldPassword' => 'Old password',
            'confirmPassword' => 'Confirm password',
            
        ];
    }

    

    public function confirmPassword($attribute){
        if($this->confirmPassword != $this->$attribute){
            $this->addError($attribute, 'Passwords must match');
        }
    }

    public function checkPassword($attribute){
        $model=MyUser::findByEmail(Yii::$app->user->identity->email);
        if(!$model->validatePassword($this->oldPassword)){
            $this->addError($attribute, 'Your old password is not correct');
        }
    }

   
}