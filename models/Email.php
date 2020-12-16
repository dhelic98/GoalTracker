<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 *
 * @property string $email
 *
 */

class Email extends Model{

    public $email;


    public function rules()
    {
        return [
            [['email'],'required','message' => 'This field is required'],
            [['email'], 'email']
           
        ];
    }

    public function attributeLabels()
    {
        return [
           
            'email' => 'Your email',
            
        ];
    }

    public static function sendEmailForPW($email){
        $model = MyUser::findByEmail($email->email);
        $pwreset_url = $model->createAbsoluteUrl('site/reset-password-now', array('key'=>$model->activation_key));
        Yii::$app->mailer->compose()
        ->setFrom('noreplygoaltracker@gmail.com')
        ->setTo($email->email)
        ->setSubject('Password reset')
        ->setHtmlBody("<h1>Welcome to J'ATTEINS MON BUT </h1></br></br>
        <p>To reset your password follow the link:</p><a href=\"$pwreset_url\">Reset</a>")
        ->send();
    }

    public function createAbsoluteUrl($string, $array){
        return "http://localhost/index.php?r=".$string."&key=".$array['key'];

    }



}


 ?>