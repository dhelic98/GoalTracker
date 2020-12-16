<?php

namespace app\models;

use Yii;
use Stripe\Stripe;


Stripe::setApiKey(Yii::$app->params['secretKey']);

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
 *
 * @property Goals[] $goals
 */
class MyUser extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
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
    public function rules()
    {
        return [
            [['email', 'password', 'first_name', 'last_name', 'gender', 'age'], 'required'],
            [['email', 'password', 'first_name', 'last_name', 'gender'], 'string'],
            [['age'], 'integer'],
            [['avatar'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg', 'maxSize' => 1024*1024*4],
            
        ];
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
            'first_name' => 'First Name',
            'last_name' => 'Last Name',
            'gender' => 'Gender',
            'age' => 'Age',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getGoals()
    {
        return $this->hasMany(Goals::className(), ['user_id' => 'id']);
    }

    public function getFullName(){

        return $this->first_name . ' '. $this->last_name;
    }



    
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new \yii\base\NotSupportedException;
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($auth_key)
    {
        return $this->auth_key === $auth_key;
    }

    public static function findByEmail($email){
        return self::findOne([ 'email' => $email ]);

    }
    
    public function validatePassword($password){
        return Yii::$app->getSecurity()->validatePassword($password, $this->password);
    }


    public function findByKey($key){
        return self::findOne(['activation_key'=> $key]);
    }

    public function activate(){
        $this->status = 1;
        $this->save();
    }

    public function updatePassword($pass){
        try{
        $newpassword = $this->generatePassword($pass);
        $this->password = $newpassword;
        $this->save();
        }
        catch(Exception $e){

        }
    }

    public function generatePassword($password){
        return Yii::$app->getSecurity()->generatePasswordHash($password);
    }


    

    public function createAbsoluteUrl($string, $array){
        return "http://localhost/index.php?r=".$string."&key=".$array['key'];

    }

    public static function getCustomer($token){
        $customer = \Stripe\Customer::create(array(
            "description" => "Customer for J'ATTEINS MON BUT",
            "source" => $token// obtained with Stripe.js
          ));

        return $customer->id;

    }

    public function uploadImage(){
        if($this->avatar == ''){
            $this->avatar = ($this->gender=='Male')? 'uploads/user-m.png' : 'uploads/user-f.png';
        }
        else if ($this->validate()) {        
            $this->avatar->saveAs('uploads/' . $this->avatar->baseName. $this->email. '.png');
            $this->avatar= $this->avatar->baseName. $this->email.'.png';
            $this->save();
            return true;
        } else {
            return false;
        }
    }

}
