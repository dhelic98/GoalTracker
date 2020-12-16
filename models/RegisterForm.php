<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "users".
 *
 * @property int $id
 * @property string $email
 * @property string $password
 * @property string $auth_key
 * @property string $first_name
 * @property string $last_name
 * @property string $gender
 * @property int $age
 * @property int $status
 * @property int $activation_key
 * @property string $billing_info
* @property string $avatar
 *
 */
class RegisterForm extends \yii\db\ActiveRecord
{

    public $confirmEmail;
    public $confirmPassword;
    

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['email', 'password', 'first_name', 'last_name', 'gender', 'age', 'confirmEmail', 'confirmPassword'], 
            'required', 'message' => 'This field can not be empty'],
            [['email', 'password', 'first_name', 'last_name', 'gender'], 'string'],
            [['age'], 'integer', 'max' => 100, 'min' => 18],
            [['email'],'email'],
            [['email'], 'isEmailUnique'],
            [['password'], 'string', 'min' => 8, 'max' => 60],
            [['password', 'confirmPassword'], 'confirmPassword'],
            [['email'], 'confirmEmail'],
            [['first_name', 'last_name'], 'validateName'],
            [['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024*1024*4],
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
            'id' => 'ID',
            'email' => 'Email',
            'password' => 'Password',
            'auth_key' => 'Authorization Key',
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'age' => 'Age',
        ];
    }

    public function validateName($attribute){
        $firstLetter = ucfirst(strtolower($this->$attribute));

        if($this->$attribute != $firstLetter){
            $this->addError($attribute, 'First letter must be capital');
        }

        
    }

    public function confirmEmail($attribute){
        if($this->confirmEmail != $this->$attribute){
            $this->addError($attribute, 'E-mails must match');
        }
    }

    public function confirmPassword($attribute){
        if($this->confirmPassword != $this->$attribute){
            $this->addError($attribute, 'Passwords must match');
        }
    }

    public function isEmailUnique($attribute){
        $email = $this->$attribute;
        if(MyUser::findByEmail($email)!=null){
            $this->addError($attribute, 'E-mail already in use');
        }

    }

    public function register(){

        
        if($this->validate()){
            $this->password = $this->generatePassword($this->password);
            $this->activation_key = sha1(mt_rand(10000, 99999).time().$this->email);
            $this->save(false);
            $activation_url = $this->createAbsoluteUrl('site/validate', array('key'=>$this->activation_key));
            $this->sendEmail($activation_url);

            if($this->uploadImage()){
                return true;
            }
        }
        else{
            return false;
        }
    }

    public function createAbsoluteUrl($string, $array){
        return "http://localhost/index.php?r=".$string."&key=".$array['key'];

    }

    public function uploadImage(){
        if($this->avatar == null){
            $this->avatar = ($this->gender=='Male')? 'uploads/user-m.png' : 'uploads/user-f.png';
            return true;
        }
        else if ($this->validate()) {
            $this->avatar->saveAs('uploads/' . $this->email . '.' . $this->avatar->extension);
            return true;
        } else {
            return false;
        }
    }

    public function generatePassword($password){
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }

    public function sendEmail($activation_url){
        Yii::$app->mailer->compose()
        ->setFrom('noreplygoaltracker@gmail.com')
        ->setTo($this->email)
        ->setSubject('Registration confirmation')
        ->setHtmlBody("<h1>Welcome to J'ATTEINS MON BUT </h1></br></br>
        <p>To confirm your registration please follow the link:</p><a href=\"$activation_url\">Verify</a>")
        ->send();
    }

}
