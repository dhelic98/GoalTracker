<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;


use app\models\LoginForm;
use app\models\ContactForm;
use app\models\MyUser;
use app\models\RegisterForm;
use app\models\Goals;
use app\models\ChangePassword;
use app\models\ResetPassword;
use app\models\Week;
use app\models\Email;

class SiteController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    public function beforeAction($action)
{
    $this->enableCsrfValidation = false;
    return parent::beforeAction($action);
}


    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    
    public function actionIndex()
    {   
        if (Yii::$app->user->isGuest) {
        
        
        $model = new RegisterForm();
        $goal = new Goals();
        
        
        if($model->load(Yii::$app->request->post()) && $model->register()){
            
            $model = MyUser::findByEmail($model->email);
            
            if($goal->load(Yii::$app->request->post()) && $goal->validate()){
                $goal->user_id = $model->id;
                $goal->saveGoal();
                Yii::$app->session->set('email', $model->email);
                return $this->redirect(['site/confirmregistration']);
            }
        }
        else{
           
            
            return $this->render('index',['model'=> $model, 'goal' => $goal]);
        }
    }
    else{
        return $this->redirect(['site/home']);
    }
       
    }


    public function actionConfirmregistration(){

        return $this->render('confirmRegistration',['email' => Yii::$app->session->get('email')]);

        
    }
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['site/home']);
        }

        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);

    }

    public function actionHowItWorks(){
        return $this->render('howitworks',[]);
    }

    public function actionChangeInfo(){
        $user = Yii::$app->user;
        if(!$user->isGuest){
            $model = MyUser::findByEmail(Yii::$app->user->identity->email);
            if($model->load(Yii::$app->request->post()) && $model->validate()){
                $model->save();
                return $this->redirect(['site/settings']);
            }
            else{
                return $this->render('changeInfo',['model' => $model]);
            }
        }
        else{
            return $this->redirect(['site/index']);
        }

    }

    public function actionChangePassword(){
        $user = Yii::$app->user;
        if(!$user->isGuest){
            $model = MyUser::findByEmail(Yii::$app->user->identity->email);
            $pass = new ChangePassword();
            if($pass->load(Yii::$app->request->post()) && $pass->validate()){
                $model->updatePassword($pass->newPassword);
                return $this->redirect(['site/settings']);
            }
            else{
                return $this->render('changePassword',['pass' => $pass]);
            }
            

        }
        else{
            return $this->redirect(['site/index']);
        }

    }

    public function actionChangeBillingInfo(){
        $user = Yii::$app->user;
        if(!$user->isGuest){
            $model = MyUser::findByEmail(Yii::$app->user->identity->email);
            if(Yii::$app->request->post()!= null){
                $model->billing_info = MyUser::getCustomer($_POST['token']);
                $model->activate();
                
                return $this->redirect(['site/settings']);
            }
            else{
                return $this->render('changeBillingInfo');
            }
        }
        else{
            return $this->redirect(['site/index']);
        }

    }

    public function actionHome(){
        $user = Yii::$app->user;
        if(!$user->isGuest){
            $model = MyUser::findByEmail(Yii::$app->user->identity->email);
            $goals = $model->goals;
            return $this->render('home',['model'=> $model, 'goals' => $goals]);
        }
        else{
            return $this->redirect(['site/index']);
        }
    }

    public function actionSettings(){
        $user = Yii::$app->user;
        if(!$user->isGuest){
            $model = MyUser::findByEmail(Yii::$app->user->identity->email);
            if(isset($_POST)){
                $model->avatar = UploadedFile::getInstance($model, 'avatar');
                $model->uploadImage();
                

            }
            
            return $this->render('settings', ['model'=>$model]);
            
        }
        else{
            return $this->redirect(['site/index']);
        }

    }


    public function actionRegister(){
        
        $user = Yii::$app->user;
        if($user->isGuest){
            $model = new RegisterForm();
            if($model->load(Yii::$app->request->post()) && $model->register()){
            
            Yii::$app->session->set('email', $model->email);
            return $this->redirect(['site/confirmregistration']);
            }
            else{
            return $this->render('register',[
                'model'=>$model    
                ]);
            }
        }
        else{
            return $this->redirect(['site/index']);
        }
    }

    public function actionValidate($key){
        $user = Yii::$app->user;
        if($key!= null || $user->isGuest){
            $model = new MyUser();
            $model = $model->findByKey($key);
            if(Yii::$app->request->post()!= null){
                $model->billing_info = MyUser::getCustomer($_POST['token']);
                $model->activate();
            
                return $this->redirect(['site/login']);
                }
            else{
                return $this->render('validation');
            }
        }
        else{
            return $this->redirect(['site/index']);   
        }
    
    
    }

    public function actionResend($email,$id){
        $user = Yii::$app->user;
        if($user->isGuest){
            if($id=='registration'){
                $model = RegisterForm::find()->where(['email' => $email])->limit(1)->one();
                $model->sendEmail($model->activation_key);
                return $this->render('confirmRegistration',['email' => $model->email]);

            }
            else if($id =='preset'){
                $model = new Email();
                $model->email = $email;
                Email::sendEmailForPW($model);
                return $this->render('confirmEmailSent',['email' =>$model]);


            }
            else{
                
                return $this->goHome();
            }
            

        }
        else{
            return $this->redirect(['site/index']);   
        }
        
        
    }

    public function actionReport($id){
        $user = Yii::$app->user;
        if(!$user->isGuest){
            $goal = Goals::findById($id);
            if($goal != null){
                $week = $goal->weekInfos[$goal->getWeekPassed()-1];
                $week->report ="";

                if($week->load(Yii::$app->request->post()) && $week->validate()){
                    $week->updateWeek($goal);
                    

                    return $this->render('confirmReport');

                }
                else{
                    return $this->render('report',['model'=> $week]);
                }
                
            }
        }
        else{
            return $this->redirect(['site/index']);   
        }

    }

   
    public function actionResetPasswordNow($key){
        $model = new MyUser();
    if(($model=$model->findByKey($key))!= null){
            $pass = new ResetPassword();
            if($pass->load(Yii::$app->request->post()) && $pass->validate()){
           
            $model->updatePassword($pass->newPassword);

            return $this->render('confirmReset');
        }
        else{
            return $this->render('resetPassword', ['key' => $key, 'pass' => $pass]);
        }
    }
    else{
        return $this->redirect(['site/index']);   
    }
    
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact('dzenan.helic@fet.ba')) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    public function actionAddNewGoal(){
        $user = Yii::$app->user;
        if(!$user->isGuest){
            $goal = new Goals();

            if($goal->load(Yii::$app->request->post()) && $goal->validate() ){
                $goal->user_id = Yii::$app->user->identity->id;
                $goal->saveGoal();
                return $this->redirect(['site/home']);
            }
            else{
                return $this->render('addNewGoal',['goal' => $goal]);
            }


        }
        else{
            return $this->redirect(['site/index']);   
        }

    }

    public function actionResetPassword(){
        $user = Yii::$app->user;
        if($user->isGuest){
            $email = new Email();
            if($email->load(Yii::$app->request->post()) && $email->validate()){
                Email::sendEmailForPW($email);
                return $this->render('confirmEmailSent',['email' =>$email]);
            }
            else{
                
                return $this->render('enterEmail', ['email' => $email]);
            }
            

        }
        else{
                return $this->redirect(['site/index']);   
            }

    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
}